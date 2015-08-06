<?php

use Talon\Http\Response;
use Talon\Http\Response\Json as JsonResponse;

class VolunteerSkillInstanceController extends UsersController {

	public function get($volunteerId, $id) {
		/** @var Volunteer $volunteer */
		$volunteer = Volunteer::findFirst($volunteerId);
		if (!$volunteer) {
			return Response::notFound();
		}
		/** @var VolunteerSkill $volunteerSkill */
		$volunteerSkill = VolunteerSkill::findFirst($id);
		if (!$volunteerSkill) {
			return Response::notFound();
		}
		if ($volunteer->getId() != $volunteerSkill->getVolunteerId()) {
			return Response::notFound();
		}

		$template = $this->getTemplate('modals/volunteer-skill-instance');

		$template->set('volunteerId', $volunteer->getId());

		foreach (Skill::find() as $skill) {
			$template->add('skills', array(
				'code' => $skill->getCode(),
				'skill' => $skill->getSkill(),
			));
		}

		$template->set('volunteerSkill', array(
			'id' => $volunteerSkill->getId(),
			'skillCode' => $volunteerSkill->getSkillCode(),
			'check' => $volunteerSkill->getCheck(),
			'license' => $volunteerSkill->getLicense(),
			'licenseAuth' => $volunteerSkill->getLicenseAuth(),
			'licenseExp' => $volunteerSkill->getLicenseExp(),
			'specialty' => $volunteerSkill->getSpecialty(),
			'comment' => $volunteerSkill->getComment(),
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
			/** @var VolunteerSkill $volunteerSkill */
			$volunteerSkill = VolunteerSkill::findFirst($id);
			if (!$volunteerSkill) {
				return Response::notFound();
			}
			if ($volunteer->getId() != $volunteerSkill->getVolunteerId()) {
				return Response::notFound();
			}

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
				$volunteerSkill->setLicenseExp($this->request->getPost('licenseExp', 'date'));
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