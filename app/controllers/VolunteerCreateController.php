<?php

use Talon\Http\Response;

class VolunteerCreateController extends UsersController {

	public function get() {
		$template = $this->getTemplate('volunteer-instance');
		return Response::ok($template);
	}
}