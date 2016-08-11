<?php

use Dubhunter\Talon\Http\RestRequest;
use Dubhunter\Talon\Flash\Bootstrap as BootstrapFlash;
use Dubhunter\Talon\Mvc\RestApplication;
use Dubhunter\Talon\Mvc\RestDispatcher;
use Dubhunter\Talon\Mvc\RestRouter;
use Dubhunter\Talon\Mvc\View\Engine\Volt;
use Dubhunter\Talon\Session\Adapter\Libmemcached as Session;
use Patchwork\Utf8\Bootup as Utf8;
use Phalcon\Loader;
use Phalcon\Filter;
use Phalcon\Di\FactoryDefault as Di;
use Phalcon\Assets\Manager as AssetManager;
use Phalcon\Config\Adapter\Ini;
use Phalcon\Db\Adapter\Pdo\Mysql;
use Phalcon\Mvc\View\Simple as View;

define('APP_DIR', realpath('../app') . '/');
define('PUBLIC_DIR', realpath('../public') . '/');
define('VENDOR_DIR', realpath('../vendor') . '/');

try {
	$loader = new Loader();
	$loader->registerDirs(array(
		APP_DIR . 'controllers/',
		APP_DIR . 'lib/',
		APP_DIR . 'models/',
	))->register();

	require VENDOR_DIR . 'autoload.php';

	$di = new Di();

	/**
	 * Setting up the credentials config
	 */
	$di->set('config', function () {
		return new Ini(APP_DIR . 'config/config.ini');
	}, true);

	/**
	 * Setting up the view component
	 */
	$di->set('view', function () use ($di) {
		$view = new View();
		$view->setViewsDir(APP_DIR . 'views/');

		$view->registerEngines(array(
			'.volt' => function ($view, $di) {
				/** @var Di $di */
				$env = $di->get('config')->get('environment');

				$volt = new Volt($view, $di, $env->realm != 'prod', 'lamorinda-cert-vrc');
				$compiler = $volt->getCompiler();

				VoltFilters::install($compiler);

				return $volt;
			},
		));

		return $view;
	}, true);

	/**
	 * Setting up the asset manager
	 */
	$di->set('assets', function () {
		return new AssetManager();
	}, true);

	/**
	 * Setting up the database connection
	 */
	$di->set('db', function () use ($di) {
		$dbConfig = $di->get('config')->get('database');
		return new Mysql(array(
			'host' => $dbConfig->host,
			'username' => $dbConfig->username,
			'password' => $dbConfig->password,
			'dbname' => $dbConfig->dbname,
		));
	}, true);

	/**
	 * Start the session the first time some component request the session service
	 */
	$di->set('session', function () use ($di) {
		$memcacheConfig = $di->get('config')->get('memcache');
		$session = new Session(
			$memcacheConfig->host,
			$memcacheConfig->port,
			$memcacheConfig->prefix,
			$memcacheConfig->lifetime
		);
		$session->start();

		return $session;
	});

	/**
	 * Setting up the filter service
	 */
	$di->set('filter', function () {
		$filter = new Filter();
		Filters::install($filter);
		return $filter;
	});

	/**
	 * Setting up the flash service
	 */
	$di->set('flash', function () {
		return new BootstrapFlash();
	});

	/**
	 * Setting up custom Request object
	 */
	$di->set('request', function () {
		return new RestRequest();
	});

	/**
	 * Setting up custom Dispatcher
	 */
	$di->set('dispatcher', function () {
		return new RestDispatcher();
	});

	/**
	 * Setting up router and mounting AppRouter
	 */
	$di->set('router', function () {
		$router = new RestRouter();
		$router->notFound('Error404');
		$router->mount(new AppRouter());
		return $router;
	});

	/**
	 * Init Patchwork/Utf8
	 */
	Utf8::initAll();

	/**
	 * Run the application
	 */
	$app = new RestApplication($di);
	$app->handle()->send();

} catch (Exception $e) {
	echo 'Uncaught Exception: ' . get_class($e) . ' ' . $e->getMessage();
}
