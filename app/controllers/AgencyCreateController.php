<?php

use Dubhunter\Talon\Http\Response;

class AgencyCreateController extends UsersController {

	public function get() {
		$template = $this->getTemplate('agency-instance');
		return Response::ok($template);
	}
}
