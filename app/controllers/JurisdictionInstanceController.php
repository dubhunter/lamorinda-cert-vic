<?php

use Talon\Http\Response;
use Talon\Http\Response\Json as JsonResponse;

class JurisdictionInstanceController extends UsersController {

	public function get($id) {
		/** @var Jurisdiction $jurisdiction */
		$jurisdiction = Jurisdiction::findFirst($id);
		if (!$jurisdiction) {
			return Response::notFound();
		}

		$template = $this->getTemplate('jurisdiction-instance');

		$template->set('jurisdiction', array(
			'id' => $jurisdiction->getId(),
			'jurisdiction' => $jurisdiction->getJurisdiction(),
		));

		return Response::ok($template);
	}

	public function post($id) {
		try {
			if (!$this->security->checkToken()) {
				throw new Exception('Something went wrong. Please try again.');
			}

			/** @var Jurisdiction $jurisdiction */
			$jurisdiction = Jurisdiction::findFirst($id);
			if (!$jurisdiction) {
				return Response::notFound();
			}

			if ($this->request->hasPost('jurisdiction')) {
				$jurisdiction->setJurisdiction($this->request->getPost('jurisdiction', 'string'));
			}
			$jurisdiction->save();

			$this->flash->success('Jurisdiction successfully saved!');
			return Response::temporaryRedirect(array('for' => 'jurisdiction-list'));
		} catch (Exception $e) {
			$this->saveValues();
			$this->flash->error($e->getMessage());
			return Response::temporaryRedirect(array('for' => 'jurisdiction-instance', 'id' => $id));
		}
	}

	public function delete($id) {
		if (!$this->user->isAdmin()) {
			return Response::forbidden();
		}

		try {
			/** @var Jurisdiction $jurisdiction */
			$jurisdiction = Jurisdiction::findFirst($id);
			if (!$jurisdiction) {
				return Response::notFound();
			}

			$jurisdiction->delete();

			$this->flash->success('Jurisdiction successfully deleted!');
			return JsonResponse::ok(array(
				'location' => $this->url->get(array('for' => 'jurisdiction-list')),
			));
		} catch (Exception $e) {
			return JsonResponse::ok(array(
				'error' => $e->getMessage(),
			));
		}
	}
}