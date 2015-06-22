<?php

use Talon\Response;

class UserCreateController extends UsersController {

	public function get() {
		if (!$this->user->isAdmin()) {
			return Response::forbidden();
		}

		$template = $this->getTemplate('user-instance');

		$template->set('roles', User::getRoles());

		return Response::ok($template);
	}
}