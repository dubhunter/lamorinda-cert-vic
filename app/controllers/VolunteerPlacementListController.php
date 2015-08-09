<?php

use Talon\Http\Response;
use Talon\Http\Response\Json as JsonResponse;

class VolunteerPlacementListController extends UsersController {

	public function get($volunteerId) {
		/** @var Volunteer $volunteer */
		$volunteer = Volunteer::findFirst($volunteerId);
		if (!$volunteer) {
			return Response::notFound();
		}

		$template = $this->getTemplate('data-lists/volunteer-placement-list');

		$template->set('volunteerId', $volunteer->getId());

		foreach ($volunteer->getVolunteerPlacements() as $volunteerPlacement) {
			$requestDetail = $volunteerPlacement->getRequestDetail();
			$agency = $requestDetail->getRequest()->getAgency();
			$template->add('volunteerPlacements', array(
				'id' => $volunteerPlacement->getId(),
				'date' => $requestDetail->getStartDate(),
				'requestId' => $requestDetail->getRequestId(),
				'agencyId' => $agency->getId(),
				'agencyName' => $agency->getName(),
				'days' => $requestDetail->getDays(),
				'comment' => $volunteerPlacement->getComment(),
			));
		}

		return Response::ok($template);
	}

	public function post($volunteerId) {
		try {
//			if (!$this->security->checkToken()) {
//				throw new Exception('Something went wrong. Please try again.');
//			}

			/** @var Volunteer $volunteer */
			$volunteer = Volunteer::findFirst($volunteerId);
			if (!$volunteer) {
				return Response::notFound();
			}

			$volunteerPlacement = new Placement();

			$volunteerPlacement->setVolunteerId($volunteer->getId());
			if ($this->request->hasPost('requestDetailId')) {
				$volunteerPlacement->setRequestDetailId($this->request->getPost('requestDetailId', 'int'));
			}
			if ($this->request->hasPost('comment')) {
				$volunteerPlacement->setComment($this->request->getPost('comment', 'string'));
			}
			$volunteerPlacement->save();

			return JsonResponse::ok(array(
				'success' => 'Volunteer availability successfully saved!',
			));
		} catch (Exception $e) {
			return JsonResponse::ok(array(
				'error' => $e->getMessage(),
			));
		}
	}
}