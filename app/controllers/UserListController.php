<?php

use Talon\Response;

class UserListController extends UsersController {

	public function get() {
		if (!$this->user->isAdmin()) {
			return Response::forbidden();
		}

		$template = $this->getTemplate('user-list');

		foreach (User::find() as $user) {
			$template->add('users', array(
				'id' => $user->getId(),
				'username' => $user->getUsername(),
				'role' => $user->getRole(),
				'roleName' => User::getRoleName($user->getRole()),
				'dateCreated' => $user->getDateCreated(),
				'dateUpdated' => $user->getDateUpdated(),
			));
		}

		return Response::ok($template);
	}

	public function post() {
		if (!$this->user->isAdmin()) {
			return Response::forbidden();
		}

		try {
			if (!$this->security->checkToken()) {
				throw new Exception('Something went wrong. Please try again.');
			}

			$user = new User();

			if ($this->request->hasPost('username')) {
				$user->setUsername($this->request->getPost('username', 'string'));
			}
			if ($this->request->hasPost('password')) {
				$user->setPassword($this->request->getPost('password', 'string'));
			}
			if ($this->request->hasPost('role')) {
				$user->setRole($this->request->getPost('role', 'int'));
			}
			$user->save();

			$this->flash->success('User successfully saved!');
			return Response::temporaryRedirect(array('for' => 'user-list'));
		} catch (Exception $e) {
			$this->flash->error($e->getMessage());
			return Response::temporaryRedirect(array('for' => 'user-create'));
		}
	}
}