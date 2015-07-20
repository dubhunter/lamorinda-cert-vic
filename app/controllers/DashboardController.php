<?php

use Talon\Http\Response;

class DashboardController extends UsersController {

	public function get() {
		$template = $this->getTemplate('dashboard');
		return Response::ok($template);
	}
}