<?php

use Talon\Http\Response;

class RequestListController extends UsersController {

	public function get() {
		$template = $this->getTemplate('request-list');
		return Response::ok($template);
	}
}