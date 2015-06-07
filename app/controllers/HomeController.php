<?php

use Talon\Response;
use Talon\RestDispatcher;
use Talon\AuthorizationException;

class HomeController extends SiteController {

	/**
	 * @param RestDispatcher $dispatcher
	 * @return bool
	 */
	public function beforeExecuteRoute($dispatcher) {
		$auth = $this->session->get('auth');
		if ($auth) {
			$dispatcher->setReturnedValue(Response::temporaryRedirect(array('for' => 'dashboard')));
			return false;
		}
		return true;
	}

	public function get() {
		$template = $this->getTemplate('home');
		return Response::ok($template);
	}

	public function post() {
		try {
			if (!$this->security->checkToken()) {
				throw new Exception('Something went wrong. Please try again.');
			}

			$username = $this->request->getPost('username', 'string');
			$password = $this->request->getPost('password', 'string');

//			$owl = Owl::findFirstByUsername($username);
//
//			if (!$owl) {
//				throw new AuthorizationException('Invalid username/password');
//			}
//
//			$throttle = Throttle::findForOwl($owl, Throttle::TYPE_LOGIN);
//			$this->throttle($throttle);
//
//			/** @var ActiveDirectory $ad */
//			$ad = $this->di->get('ldap');
//
//			if (!$ad->authenticate($username, $password)) {
//				$throttle->relock();
//				$this->throttle($throttle);
//				throw new AuthorizationException('Invalid username/password');
//			}
//
//			$throttle->unlock();
//
//			$this->session->set('auth', array(
//				'guid' => $owl->getGuid(),
//			));

			if ($this->session->has('target')) {
				$redirect = $this->session->get('target');
				$this->session->remove('target');
			} else {
				$redirect = array('for' => 'dashboard');
			}

			return Response::temporaryRedirect($redirect);
		} catch (Exception $e) {
			$this->flash->error($e->getMessage());
			return Response::temporaryRedirect(array('for' => 'home'));
		}
	}

}