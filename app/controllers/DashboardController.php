<?php

use Dubhunter\Talon\Http\Response;

class DashboardController extends UsersController {

	public function get() {
		$template = $this->getTemplate('dashboard');

		$template->set('volunteers', [
			'available' => Volunteer::countAvailable(),
			'total' => Volunteer::count(),
		]);

		$template->set('requests', [
			'open' => Request::countOpen(),
			'total' => Request::count(),
		]);

		$template->set('agencies', [
			'open' => Agency::countOpenRequests(),
			'total' => Agency::count(),
		]);

		return Response::ok($template);
	}
}
