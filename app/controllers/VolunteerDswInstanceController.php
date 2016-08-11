<?php

use Dubhunter\Talon\Http\Response;
use Dubhunter\Talon\Http\Response\Json as JsonResponse;

class VolunteerDswInstanceController extends UsersController {

	public function get($volunteerId, $id) {
		/** @var Volunteer $volunteer */
		$volunteer = Volunteer::findFirst($volunteerId);
		if (!$volunteer) {
			return Response::notFound();
		}
		/** @var DSW $volunteerDsw */
		$volunteerDsw = DSW::findFirst($id);
		if (!$volunteerDsw) {
			return Response::notFound();
		}
		if ($volunteer->getId() != $volunteerDsw->getVolunteerId()) {
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

		$template->set('volunteerDsw', [
			'id' => $volunteerDsw->getId(),
			'dswClassId' => $volunteerDsw->getDswClassId(),
			'jurisdictionId' => $volunteerDsw->getJurisdictionId(),
			'swornBy' => $volunteerDsw->getSwornBy(),
		]);

		return Response::ok($template);
	}

	public function post($volunteerId, $id) {
		if (!$this->user->isAdmin()) {
			return Response::forbidden();
		}

		try {
//			if (!$this->security->checkToken()) {
//				throw new Exception('Something went wrong. Please try again.');
//			}

			/** @var Volunteer $volunteer */
			$volunteer = Volunteer::findFirst($volunteerId);
			if (!$volunteer) {
				return Response::notFound();
			}
			/** @var DSW $volunteerDsw */
			$volunteerDsw = DSW::findFirst($id);
			if (!$volunteerDsw) {
				return Response::notFound();
			}
			if ($volunteer->getId() != $volunteerDsw->getVolunteerId()) {
				return Response::notFound();
			}

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

			return JsonResponse::ok([
				'success' => 'Volunteer dsw designation successfully saved!',
			]);
		} catch (Exception $e) {
			return JsonResponse::ok([
				'error' => $e->getMessage(),
			]);
		}
	}
}
