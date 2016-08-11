<?php

use Dubhunter\Talon\Http\Response;

class RequestListController extends UsersController {

	public function get() {
		$template = $this->getTemplate('request-list');

		$options = [];

		$search = $this->request->getQuery('q', ['string', 'trim']);

		if (!empty($search)) {
			$search = strtolower($search);

			$options['conditions'] = 'LOWER(contact) = :search:';
			$options['conditions'] .= ' OR LOWER(email) = :search:';
			$options['conditions'] .= ' OR phone_work = :search: OR fax = :search: OR phone_cell = :search:';
			$options['bind'] = array(
				'search' => $search,
			);
		}

		foreach (Request::find($options) as $request) {
			$agency = $request->getAgency();
			$jurisdiction = $request->getJurisdiction();
			$template->add('requests', [
				'id' => $request->getId(),
				'agencyId' => $request->getAgencyId(),
				'agency' => $agency->getName(),
				'street' => $request->getStreet(),
				'jurisdictionId' => $request->getJurisdictionId(),
				'jurisdiction' => $jurisdiction->getJurisdiction(),
				'contact' => $request->getContact(),
				'phoneWork' => $request->getPhoneWork(),
				'fax' => $request->getFax(),
				'phoneCell' => $request->getPhoneCell(),
				'email' => $request->getEmail(),
				'radio' => $request->getRadio(),
				'comment' => $request->getComment(),
				'open' => $request->getOpen(),
			]);
		}

		return Response::ok($template);
	}

	public function post() {
		try {
			if (!$this->security->checkToken()) {
				throw new Exception('Something went wrong. Please try again.');
			}

			$request = new Request();

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
			return Response::temporaryRedirect(['for' => 'request-list']);
		} catch (Exception $e) {
			$this->saveValues();
			$this->flash->error($e->getMessage());
			return Response::temporaryRedirect(['for' => 'request-create']);
		}
	}
}
