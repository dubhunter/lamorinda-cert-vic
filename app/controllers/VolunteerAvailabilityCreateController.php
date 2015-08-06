<?php

use Talon\Http\Response;
use Talon\Http\Response\Json as JsonResponse;

class VolunteerAvailabilityCreateController extends UsersController {

	public function get($volunteerId) {
		/** @var Volunteer $volunteer */
		$volunteer = Volunteer::findFirst($volunteerId);
		if (!$volunteer) {
			return Response::notFound();
		}

		$template = $this->getTemplate('modals/volunteer-availability-instance');

		$template->set('volunteerId', $volunteer->getId());

		return Response::ok($template);
	}
}