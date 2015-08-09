<?php

use Talon\Http\Response;

class SkillListController extends UsersController {

	public function get() {
		$template = $this->getTemplate('skill-list');

		foreach (Skill::find() as $skill) {
			$template->add('skills', array(
				'code' => $skill->getCode(),
				'skill' => $skill->getSkill(),
			));
		}

		return Response::ok($template);
	}

	public function post() {
		try {
			if (!$this->security->checkToken()) {
				throw new Exception('Something went wrong. Please try again.');
			}

			$skill = new Skill();

			if ($this->request->hasPost('code')) {
				$skill->setCode($this->request->getPost('code', 'string'));
			}
			if ($this->request->hasPost('skill')) {
				$skill->setSkill($this->request->getPost('skill', 'string'));
			}
			$skill->save();

			$this->flash->success('Skill successfully saved!');
			return Response::temporaryRedirect(array('for' => 'skill-list'));
		} catch (Exception $e) {
			$this->saveValues();
			$this->flash->error($e->getMessage());
			return Response::temporaryRedirect(array('for' => 'skill-create'));
		}
	}
}