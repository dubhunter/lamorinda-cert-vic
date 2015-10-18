<?php

use Talon\Http\Response;
use Talon\Http\Response\Json as JsonResponse;

class VolunteerPlacementInstanceBadgeController extends UsersController {

	public function get($volunteerId, $id) {
		/** @var Volunteer $volunteer */
		$volunteer = Volunteer::findFirst($volunteerId);
		if (!$volunteer) {
			return Response::notFound();
		}
		/** @var Placement $volunteerPlacement */
		$volunteerPlacement = Placement::findFirst($id);
		if (!$volunteerPlacement) {
			return Response::notFound();
		}
		if ($volunteer->getId() != $volunteerPlacement->getVolunteerId()) {
			return Response::notFound();
		}

		$requestDetail = $volunteerPlacement->getRequestDetail();
		$request = $requestDetail->getRequest();
		$agency = $request->getAgency();
		$skill = $requestDetail->getSkill();
		$dsw = $volunteer->getVolunteerDsw(array(
			'conditions' => 'jurisdiction_id = :jurisdiction:',
			'bind' => array(
				'jurisdiction' => $request->getJurisdictionId(),
			),
		));

		$template = $this->getTemplate('volunteer-placement-badge');

		$template->set('volunteer', array(
			'id' => $volunteer->getId(),
			'nameFirst' => $volunteer->getNameFirst(),
			'nameLast' => $volunteer->getNameLast(),
			'nameMiddle' => $volunteer->getNameMiddle(),
			'backgroundChecked' => (bool)$volunteer->getBackgroundTime(),
			'hasImage' => $volunteer->hasImage(),
			'dsw' => $dsw,
		));

		$template->set('agency', array(
			'id' => $agency->getId(),
			'name' => $agency->getName(),
			'street' => $agency->getStreet(),
			'city' => $agency->getCity(),
		));

		$template->set('requestDetail', array(
			'skill' => $skill->getSkill(),
			'endDate' => $requestDetail->getEndDate(),
		));

		return Response::ok($template);
	}
}