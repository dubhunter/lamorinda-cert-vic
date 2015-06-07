<?php

use Talon\Response;

class LogoutController extends UsersController {

	public function get() {
		$this->session->remove('auth');
		$this->session->destroy();
		$this->flash->notice('You have been logged out.');
		return Response::temporaryRedirect(array('for' => 'home'));
	}

}