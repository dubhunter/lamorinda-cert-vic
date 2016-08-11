<?php

use Dubhunter\Talon\Http\Response;
use Dubhunter\Talon\Http\Response\Json as JsonResponse;

class VolunteerPlacementInstanceController extends UsersController {

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

		$template->set('volunteerPlacement', [
			'id' => $volunteerPlacement->getId(),
			'requestDetailId' => $volunteerPlacement->getRequestDetailId(),
			'comment' => $volunteerPlacement->getComment(),
		]);

		return Response::ok($template);
	}

	public function post($volunteerId, $id) {
		try {
//			if (!$this->security->checkToken()) {
//				throw new Exception('Something went wrong. Please try again.');
//			}

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

			if ($this->request->hasPost('requestDetailId')) {
				$volunteerPlacement->setRequestDetailId($this->request->getPost('requestDetailId', 'int'));
			}
			if ($this->request->hasPost('comment')) {
				$volunteerPlacement->setComment($this->request->getPost('comment', 'string'));
			}
			$volunteerPlacement->save();

			return JsonResponse::ok([
				'success' => 'Volunteer placement successfully saved!',
			]);
		} catch (Exception $e) {
			return JsonResponse::ok([
				'error' => $e->getMessage(),
			]);
		}
	}
}
