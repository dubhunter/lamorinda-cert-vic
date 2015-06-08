<?php

use Talon\Response;

class VolunteerListController extends UsersController {

	public function get() {
		$template = $this->getTemplate('volunteer-list');
		return Response::ok($template);
	}
}