<?php

use Phalcon\Loader;
use Phalcon\Di\FactoryDefault\Cli as Di;
use Phalcon\CLI\Console as ConsoleApp;
use Phalcon\Config\Adapter\Ini;
use Phalcon\Db\Adapter\Pdo\Mysql;

define('VERSION', '1.0.0');

// Define path to application directory
define('APP_DIR', realpath(dirname(__FILE__)) . '/');
define('VENDOR_DIR', realpath(APP_DIR . '../vendor') . '/');

/**
 * Register the autoloader and tell it to register the tasks directory
 */
$loader = new Loader();
$loader->registerDirs(array(
	APP_DIR . 'lib/',
	APP_DIR . 'models/',
	APP_DIR . 'tasks/',
))->register();

require VENDOR_DIR . 'autoload.php';

//Using the CLI factory default services container
$di = new Di();

/**
 * Setting up the credentials config
 */
$di->set('config', function () {
	return new Ini(APP_DIR . 'config/config.ini');
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
 * Process the console arguments
 */
$arguments = array();
foreach ($argv as $k => $arg) {
	if ($k == 1) {
		$arguments['task'] = $arg;
	} elseif ($k == 2) {
		$arguments['action'] = $arg;
	} elseif ($k >= 3) {
		$arguments[] = $arg;
	}
}

// define global constants for the current task and action
define('CURRENT_TASK', (isset($argv[1]) ? $argv[1] : null));
define('CURRENT_ACTION', (isset($argv[2]) ? $argv[2] : null));

try {
	$console = new ConsoleApp($di);
	$console->handle($arguments);
} catch (\Phalcon\Exception $e) {
	echo $e->getMessage();
	exit(255);
}
