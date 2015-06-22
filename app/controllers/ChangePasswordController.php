<?php

use Talon\Response;

class ChangePasswordController extends UsersController {

	public function get() {
		$template = $this->getTemplate('change-password');

		return Response::ok($template);
	}

	public function post() {
		try {
			if (!$this->security->checkToken()) {
				throw new Exception('Something went wrong. Please try again.');
			}

			if (!$this->request->hasPost('password') || !strlen($this->request->getPost('password', 'string'))) {
				throw new Exception('You must enter a new password.');
			}

			if ($this->request->getPost('password', 'string') != $this->request->getPost('passwordConfirm', 'string')) {
				throw new Exception('You must confirm the new password.');
			}

			$this->user->setPassword($this->request->getPost('password', 'string'));
			$this->user->save();

			$this->flash->success('Password successfully changed!');
			return Response::temporaryRedirect(array('for' => 'dashboard'));
		} catch (Exception $e) {
			$this->flash->error($e->getMessage());
			return Response::temporaryRedirect(array('for' => 'change-password'));
		}
	}
}