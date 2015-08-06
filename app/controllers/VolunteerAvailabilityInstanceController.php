<?php

use Talon\Http\Response;
use Talon\Http\Response\Json as JsonResponse;

class VolunteerAvailabilityInstanceController extends UsersController {

	public function get($volunteerId, $id) {
		/** @var Volunteer $volunteer */
		$volunteer = Volunteer::findFirst($volunteerId);
		if (!$volunteer) {
			return Response::notFound();
		}
		/** @var VolunteerAvailability $volunteerAvailability */
		$volunteerAvailability = VolunteerAvailability::findFirst($id);
		if (!$volunteerAvailability) {
			return Response::notFound();
		}
		if ($volunteer->getId() != $volunteerAvailability->getVolunteerId()) {
			return Response::notFound();
		}

		$template = $this->getTemplate('modals/volunteer-availability-instance');

		$template->set('volunteerId', $volunteer->getId());

		$template->set('volunteerAvailability', array(
			'id' => $volunteerAvailability->getId(),
			'date' => $volunteerAvailability->getDate(),
			'start' => $volunteerAvailability->getStart(),
			'end' => $volunteerAvailability->getEnd(),
			'comment' => $volunteerAvailability->getComment(),
			'open' => $volunteerAvailability->getOpen(),
		));

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
			/** @var VolunteerAvailability $volunteerAvailability */
			$volunteerAvailability = VolunteerAvailability::findFirst($id);
			if (!$volunteerAvailability) {
				return Response::notFound();
			}
			if ($volunteer->getId() != $volunteerAvailability->getVolunteerId()) {
				return Response::notFound();
			}

			if ($this->request->hasPost('date')) {
				$volunteerAvailability->setDate($this->request->getPost('date', 'date'));
			}
			if ($this->request->hasPost('start')) {
				$volunteerAvailability->setStart($this->request->getPost('start', 'time'));
			}
			if ($this->request->hasPost('end')) {
				$volunteerAvailability->setEnd($this->request->getPost('end', 'time'));
			}
			if ($this->request->hasPost('comment')) {
				$volunteerAvailability->setComment($this->request->getPost('comment', 'string'));
			}
			$volunteerAvailability->setOpen($this->request->getPost('open', 'int'));
			$volunteerAvailability->save();

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