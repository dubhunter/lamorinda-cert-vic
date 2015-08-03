<?php

use Talon\Http\Response;
use Talon\Http\Response\Json as JsonResponse;

class VolunteerSkillListController extends UsersController {

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

			$volunteerSkill = new VolunteerSkill();

			$volunteerSkill->setVolunteerId($volunteer->getId());
			if ($this->request->hasPost('skillCode')) {
				$volunteerSkill->setSkillCode($this->request->getPost('skillCode', 'string'));
			}
			$volunteerSkill->setCheck($this->request->getPost('check', 'int'));
			if ($this->request->hasPost('license')) {
				$volunteerSkill->setLicense($this->request->getPost('license', 'string'));
			}
			if ($this->request->hasPost('licenseAuth')) {
				$volunteerSkill->setLicenseAuth($this->request->getPost('licenseAuth', 'string'));
			}
			if ($this->request->hasPost('licenseExp')) {
				$volunteerSkill->setLicenseExp($this->request->getPost('licenseExp', 'int'));
			}
			if ($this->request->hasPost('specialty')) {
				$volunteerSkill->setSpecialty($this->request->getPost('specialty', 'string'));
			}
			if ($this->request->hasPost('comment')) {
				$volunteerSkill->setComment($this->request->getPost('comment', 'string'));
			}
			$volunteerSkill->save();

			return JsonResponse::ok(array(
				'success' => 'Volunteer skill successfully saved!',
			));
		} catch (Exception $e) {
			return JsonResponse::ok(array(
				'error' => $e->getMessage(),
			));
		}
	}
}