<?php

use Dubhunter\Talon\Http\Response;

class JurisdictionCreateController extends UsersController {

	public function get() {
		if (!$this->user->isAdmin()) {
			return Response::forbidden();
		}

		$template = $this->getTemplate('jurisdiction-instance');
		return Response::ok($template);
	}
}
