<?php

use Talon\Http\Response;
use Talon\Http\Response\Json as JsonResponse;

class DSWClassInstanceController extends UsersController {

	public function get($id) {
		/** @var DSWClass $dswClass */
		$dswClass = DSWClass::findFirst($id);
		if (!$dswClass) {
			return Response::notFound();
		}

		$template = $this->getTemplate('dsw-class-instance');

		$template->set('dswClass', array(
			'id' => $dswClass->getId(),
			'class' => $dswClass->getClass(),
		));

		return Response::ok($template);
	}

	public function post($id) {
		try {
			if (!$this->security->checkToken()) {
				throw new Exception('Something went wrong. Please try again.');
			}

			/** @var DSWClass $dswClass */
			$dswClass = DSWClass::findFirst($id);
			if (!$dswClass) {
				return Response::notFound();
			}

			if ($this->request->hasPost('class')) {
				$dswClass->setClass($this->request->getPost('class', 'string'));
			}
			$dswClass->save();

			$this->flash->success('DSW Class successfully saved!');
			return Response::temporaryRedirect(array('for' => 'dsw-class-list'));
		} catch (Exception $e) {
			$this->saveValues();
			$this->flash->error($e->getMessage());
			return Response::temporaryRedirect(array('for' => 'dsw-class-instance', 'id' => $id));
		}
	}

	public function delete($id) {
		if (!$this->user->isAdmin() || $id == $this->user->getId()) {
			return Response::forbidden();
		}

		try {
			/** @var DSWClass $dswClass */
			$dswClass = DSWClass::findFirst($id);
			if (!$dswClass) {
				return Response::notFound();
			}

			$dswClass->delete();

			$this->flash->success('DSW Class successfully deleted!');
			return JsonResponse::ok(array(
				'location' => $this->url->get(array('for' => 'dsw-class-list')),
			));
		} catch (Exception $e) {
			return JsonResponse::ok(array(
				'error' => $e->getMessage(),
			));
		}
	}
}