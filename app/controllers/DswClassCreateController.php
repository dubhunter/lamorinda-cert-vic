<?php

use Dubhunter\Talon\Http\Response;

class DswClassCreateController extends UsersController {

	public function get() {
		if (!$this->user->isAdmin()) {
			return Response::forbidden();
		}

		$template = $this->getTemplate('dsw-class-instance');
		return Response::ok($template);
	}
}
