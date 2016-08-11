<?php

use Dubhunter\Talon\Http\Response;
use Dubhunter\Talon\Mvc\RestDispatcher;
use Dubhunter\Talon\Exception\Authorization as AuthorizationException;

class HomeController extends SiteController {

	/**
	 * @param RestDispatcher $dispatcher
	 * @return bool
	 */
	public function beforeExecuteRoute($dispatcher) {
		$auth = $this->session->get('auth');
		if ($auth) {
			$dispatcher->setReturnedValue(Response::temporaryRedirect(['for' => 'dashboard']));
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

			$user = User::findFirstByUsername($username);

			if (!$user) {
				throw new AuthorizationException('Invalid username/password');
			}

			if (!$this->security->checkHash($password, $user->getPassword())) {
				throw new AuthorizationException('Invalid username/password');
			}

			$this->session->set('auth', [
				'id' => $user->getId(),
			]);


			if ($this->session->has('target')) {
				$redirect = $this->session->get('target');
				$this->session->remove('target');
			} else {
				$redirect = ['for' => 'dashboard'];
			}

			return Response::temporaryRedirect($redirect);
		} catch (Exception $e) {
			$this->flash->error($e->getMessage());
			return Response::temporaryRedirect(['for' => 'home']);
		}
	}

}
