<?php

use Talon\Http\Response;
use Talon\Http\Response\Json as JsonResponse;

class VolunteerAvailabilityListController extends UsersController {

	public function get($volunteerId) {
		/** @var Volunteer $volunteer */
		$volunteer = Volunteer::findFirst($volunteerId);
		if (!$volunteer) {
			return Response::notFound();
		}

		$template = $this->getTemplate('data-lists/volunteer-availability-list');

		$template->set('volunteerId', $volunteer->getId());

		foreach ($volunteer->getVolunteerAvailability() as $volunteerAvailability) {
			$template->add('volunteerAvailability', array(
				'id' => $volunteerAvailability->getId(),
				'date' => $volunteerAvailability->getDate(),
				'start' => $volunteerAvailability->getStart(),
				'end' => $volunteerAvailability->getEnd(),
				'comment' => $volunteerAvailability->getComment(),
				'open' => $volunteerAvailability->getOpen(),
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

			$volunteerAvailability = new VolunteerAvailability();

			$volunteerAvailability->setVolunteerId($volunteer->getId());
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