<?php

use Talon\Http\Response;

class RequestInstanceController extends UsersController {

	public function get($id) {
		/** @var Request $request */
		$request = Request::findFirst($id);
		if (!$request) {
			return Response::notFound();
		}

		$template = $this->getTemplate('request-instance');

		foreach (Agency::find() as $agency) {
			$template->add('agencies', array(
				'id' => $agency->getId(),
				'name' => $agency->getName(),
			));
		}

		foreach (Jurisdiction::find() as $jurisdiction) {
			$template->add('jurisdictions', array(
				'id' => $jurisdiction->getId(),
				'jurisdiction' => $jurisdiction->getJurisdiction(),
			));
		}

		$template->set('request', array(
			'id' => $request->getId(),
			'agencyId' => $request->getAgencyId(),
			'street' => $request->getStreet(),
			'jurisdictionId' => $request->getJurisdictionId(),
			'contact' => $request->getContact(),
			'phoneWork' => $request->getPhoneWork(),
			'fax' => $request->getFax(),
			'phoneCell' => $request->getPhoneCell(),
			'email' => $request->getEmail(),
			'radio' => $request->getRadio(),
			'comment' => $request->getComment(),
			'open' => $request->getOpen(),
		));

		return Response::ok($template);
	}

	public function post($id) {
		try {
			if (!$this->security->checkToken()) {
				throw new Exception('Something went wrong. Please try again.');
			}

			/** @var Request $request */
			$request = Request::findFirst($id);
			if (!$request) {
				return Response::notFound();
			}

			if ($this->request->hasPost('agencyId')) {
				$request->setAgencyId($this->request->getPost('agencyId', 'string'));
			}
			if ($this->request->hasPost('street')) {
				$request->setStreet($this->request->getPost('street', 'string'));
			}
			if ($this->request->hasPost('jurisdictionId')) {
				$request->setJurisdictionId($this->request->getPost('jurisdictionId', 'int'));
			}
			if ($this->request->hasPost('contact')) {
				$request->setContact($this->request->getPost('contact', 'string'));
			}
			if ($this->request->hasPost('phoneWork')) {
				$request->setPhoneWork($this->request->getPost('phoneWork', 'phone'));
			}
			if ($this->request->hasPost('fax')) {
				$request->setFax($this->request->getPost('fax', 'phone'));
			}
			if ($this->request->hasPost('phoneCell')) {
				$request->setPhoneCell($this->request->getPost('phoneCell', 'phone'));
			}
			if ($this->request->hasPost('email')) {
				$request->setEmail($this->request->getPost('email', 'email'));
			}
			if ($this->request->hasPost('radio')) {
				$request->setRadio($this->request->getPost('radio', 'string'));
			}
			if ($this->request->hasPost('comment')) {
				$request->setComment($this->request->getPost('comment', 'string'));
			}
			$request->setOpen($this->request->getPost('open', 'int'));
			$request->save();

			$this->flash->success('Request successfully saved!');
			return Response::temporaryRedirect(array('for' => 'request-list'));
		} catch (Exception $e) {
			$this->saveValues();
			$this->flash->error($e->getMessage());
			return Response::temporaryRedirect(array('for' => 'request-instance', 'id' => $id));
		}
	}
}