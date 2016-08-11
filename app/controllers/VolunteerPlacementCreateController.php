<?php

use Dubhunter\Talon\Http\Response;
use Dubhunter\Talon\Http\Response\Json as JsonResponse;

class VolunteerPlacementCreateController extends UsersController {

	public function get($volunteerId) {
		/** @var Volunteer $volunteer */
		$volunteer = Volunteer::findFirst($volunteerId);
		if (!$volunteer) {
			return Response::notFound();
		}

		$template = $this->getTemplate('modals/volunteer-placement-instance');

		$template->set('volunteerId', $volunteer->getId());

		foreach (Request::findOpen() as $request) {
			$requestDetails = [];
			foreach ($request->getOpenRequestDetails() as $requestDetail) {
				$skill = $requestDetail->getSkill();
				$requestDetails[] = array(
					'id' => $requestDetail->getId(),
					'code' => $skill->getCode(),
					'skill' => $skill->getSkill(),
					'startDate' => $requestDetail->getStartDate(),
					'startTime' => $requestDetail->getStartTime(),
				);
			}
			$agency = $request->getAgency();
			$template->add('requests', [
				'id' => $request->getId(),
				'agencyId' => $agency->getId(),
				'agencyName' => $agency->getName(),
				'requestDetails' => $requestDetails,
			]);
		}

		return Response::ok($template);
	}
}
