<?php

use Dubhunter\Talon\Http\Response;

class JurisdictionListController extends UsersController {

	public function get() {
		$template = $this->getTemplate('jurisdiction-list');

		foreach (Jurisdiction::find() as $jurisdiction) {
			$template->add('jurisdictions', [
				'id' => $jurisdiction->getId(),
				'jurisdiction' => $jurisdiction->getJurisdiction(),
			]);
		}

		return Response::ok($template);
	}

	public function post() {
		try {
			if (!$this->security->checkToken()) {
				throw new Exception('Something went wrong. Please try again.');
			}

			$jurisdiction = new Jurisdiction();

			if ($this->request->hasPost('jurisdiction')) {
				$jurisdiction->setJurisdiction($this->request->getPost('jurisdiction', 'string'));
			}
			$jurisdiction->save();

			$this->flash->success('Jurisdiction successfully saved!');
			return Response::temporaryRedirect(['for' => 'jurisdiction-list']);
		} catch (Exception $e) {
			$this->saveValues();
			$this->flash->error($e->getMessage());
			return Response::temporaryRedirect(['for' => 'jurisdiction-create']);
		}
	}
}
