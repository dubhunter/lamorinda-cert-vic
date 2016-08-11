<?php

use Dubhunter\Talon\Http\Response;

class LogoutController extends UsersController {

	public function get() {
		$this->session->remove('auth');
		$this->session->destroy();
		$this->flash->notice('You have been logged out.');
		return Response::temporaryRedirect(['for' => 'home']);
	}

}
