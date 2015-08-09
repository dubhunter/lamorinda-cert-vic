<?php

use Talon\Http\Response;

class SkillCreateController extends UsersController {

	public function get() {
		if (!$this->user->isAdmin()) {
			return Response::forbidden();
		}

		$template = $this->getTemplate('skill-instance');
		return Response::ok($template);
	}
}