<?php

use Talon\Http\Response;

class DashboardController extends UsersController {

	public function get() {
		$template = $this->getTemplate('dashboard');

		$template->set('volunteers', array(
			'available' => Volunteer::countAvailable(),
			'total' => Volunteer::count(),
		));

		$template->set('requests', array(
			'open' => Request::countOpen(),
			'total' => Request::count(),
		));

		$template->set('agencies', array(
			'open' => Agency::countOpenRequests(),
			'total' => Agency::count(),
		));

		return Response::ok($template);
	}
}