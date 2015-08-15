<?php

use Talon\Http\Response;
use Talon\Http\Response\Json as JsonResponse;

class VolunteerDswListController extends UsersController {

	public function get($volunteerId) {
		/** @var Volunteer $volunteer */
		$volunteer = Volunteer::findFirst($volunteerId);
		if (!$volunteer) {
			return Response::notFound();
		}

		$template = $this->getTemplate('data-lists/volunteer-dsw-list');

		$template->set('volunteerId', $volunteer->getId());

		foreach ($volunteer->getVolunteerDsw() as $volunteerDsw) {
			$dswClass = $volunteerDsw->getDswClass();
			$jurisdiction = $volunteerDsw->getJurisdiction();
			$template->add('volunteerDsw', array(
				'id' => $volunteerDsw->getId(),
				'class' => $dswClass->getClass(),
				'jurisdiction' => $jurisdiction->getJurisdiction(),
				'swornBy' => $volunteerDsw->getSwornBy(),
				'date' => $volunteerDsw->getDate(),
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

			$volunteerDsw = new DSW();

			$volunteerDsw->setVolunteerId($volunteer->getId());
			if ($this->request->hasPost('dswClassId')) {
				$volunteerDsw->setDswClassId($this->request->getPost('dswClassId', 'int'));
			}
			if ($this->request->hasPost('jurisdictionId')) {
				$volunteerDsw->setJurisdictionId($this->request->getPost('jurisdictionId', 'int'));
			}
			if ($this->request->hasPost('swornBy')) {
				$volunteerDsw->setSwornBy($this->request->getPost('swornBy', 'string'));
			}
			$volunteerDsw->save();

			return JsonResponse::ok(array(
				'success' => 'Volunteer dsw designation successfully saved!',
			));
		} catch (Exception $e) {
			return JsonResponse::ok(array(
				'error' => $e->getMessage(),
			));
		}
	}
}