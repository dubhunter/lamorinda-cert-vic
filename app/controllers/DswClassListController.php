<?php

use Talon\Http\Response;

class DswClassListController extends UsersController {

	public function get() {
		$template = $this->getTemplate('dsw-class-list');

		foreach (DSWClass::find() as $dswClass) {
			$template->add('dswClasses', array(
				'id' => $dswClass->getId(),
				'class' => $dswClass->getClass(),
			));
		}

		return Response::ok($template);
	}

	public function post() {
		try {
			if (!$this->security->checkToken()) {
				throw new Exception('Something went wrong. Please try again.');
			}

			$dswClass = new DSWClass();

			if ($this->request->hasPost('class')) {
				$dswClass->setClass($this->request->getPost('class', 'string'));
			}
			$dswClass->save();

			$this->flash->success('DSW Class successfully saved!');
			return Response::temporaryRedirect(array('for' => 'dsw-class-list'));
		} catch (Exception $e) {
			$this->saveValues();
			$this->flash->error($e->getMessage());
			return Response::temporaryRedirect(array('for' => 'dsw-class-create'));
		}
	}
}