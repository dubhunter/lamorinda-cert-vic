<?php

use Talon\Http\Response;
use Talon\Http\Response\Json as JsonResponse;

class UserInstanceController extends UsersController {

	public function get($id) {
		if (!$this->user->isAdmin() || $id == $this->user->getId()) {
			return Response::forbidden();
		}

		/** @var User $user */
		$user = User::findFirst($id);
		if (!$user) {
			return Response::notFound();
		}

		$template = $this->getTemplate('user-instance');

		$template->set('roles', User::getRoles());

		$template->set('user', array(
			'id' => $user->getId(),
			'username' => $user->getUsername(),
			'role' => $user->getRole(),
			'roleName' => User::getRoleName($user->getRole()),
			'dateCreated' => $user->getDateCreated(),
			'dateUpdated' => $user->getDateUpdated(),
		));

		return Response::ok($template);
	}

	public function post($id) {
		if (!$this->user->isAdmin() || $id == $this->user->getId()) {
			return Response::forbidden();
		}

		try {
			if (!$this->security->checkToken()) {
				throw new Exception('Something went wrong. Please try again.');
			}

			/** @var User $user */
			$user = User::findFirst($id);
			if (!$user) {
				return Response::notFound();
			}

			if ($this->request->hasPost('username')) {
				$user->setUsername($this->request->getPost('username', 'string'));
			}
			if ($this->request->hasPost('password') && strlen($this->request->getPost('password', 'string'))) {
				$user->setPassword($this->request->getPost('password', 'string'));
			}
			if ($this->request->hasPost('role')) {
				$user->setRole($this->request->getPost('role', 'int'));
			}
			$user->save();

			$this->flash->success('User successfully saved!');
			return Response::temporaryRedirect(array('for' => 'user-list'));
		} catch (Exception $e) {
			$this->saveValues();
			$this->flash->error($e->getMessage());
			return Response::temporaryRedirect(array('for' => 'user-instance', 'id' => $id));
		}
	}

	public function delete($id) {
		if (!$this->user->isAdmin() || $id == $this->user->getId()) {
			return Response::forbidden();
		}

		try {
			/** @var User $user */
			$user = User::findFirst($id);
			if (!$user) {
				return Response::notFound();
			}

			$user->delete();

			$this->flash->success('User successfully deleted!');
			return JsonResponse::ok(array(
				'location' => $this->url->get(array('for' => 'user-list')),
			));
		} catch (Exception $e) {
			return JsonResponse::ok(array(
				'error' => $e->getMessage(),
			));
		}
	}
}