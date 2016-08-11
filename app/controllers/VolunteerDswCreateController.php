<?php

use Dubhunter\Talon\Http\Response;
use Dubhunter\Talon\Http\Response\Json as JsonResponse;

class VolunteerDswCreateController extends UsersController {

	public function get($volunteerId) {
		/** @var Volunteer $volunteer */
		$volunteer = Volunteer::findFirst($volunteerId);
		if (!$volunteer) {
			return Response::notFound();
		}

		$template = $this->getTemplate('modals/volunteer-dsw-instance');

		$template->set('volunteerId', $volunteer->getId());

		foreach (DSWClass::find() as $dswClass) {
			$template->add('dswClasses', [
				'id' => $dswClass->getId(),
				'class' => $dswClass->getClass(),
			]);
		}

		foreach (Jurisdiction::find() as $jurisdiction) {
			$template->add('jurisdictions', [
				'id' => $jurisdiction->getId(),
				'jurisdiction' => $jurisdiction->getJurisdiction(),
			]);
		}

		return Response::ok($template);
	}
}
