<?php

use Dubhunter\Talon\Http\Response;
use Dubhunter\Talon\Http\Response\Json as JsonResponse;

class SkillInstanceController extends UsersController {

	public function get($code) {
		/** @var Skill $skill */
		$skill = Skill::findFirst($code);
		if (!$skill) {
			return Response::notFound();
		}

		$template = $this->getTemplate('skill-instance');

		$template->set('skill', [
			'code' => $skill->getCode(),
			'skill' => $skill->getSkill(),
		]);

		return Response::ok($template);
	}

	public function post($code) {
		try {
			if (!$this->security->checkToken()) {
				throw new Exception('Something went wrong. Please try again.');
			}

			/** @var Skill $skill */
			$skill = Skill::findFirst($code);
			if (!$skill) {
				return Response::notFound();
			}

			if ($this->request->hasPost('code')) {
				$skill->setCode($this->request->getPost('code', 'string'));
			}
			if ($this->request->hasPost('skill')) {
				$skill->setSkill($this->request->getPost('skill', 'string'));
			}
			$skill->save();

			$this->flash->success('Skill successfully saved!');
			return Response::temporaryRedirect(['for' => 'skill-list']);
		} catch (Exception $e) {
			$this->saveValues();
			$this->flash->error($e->getMessage());
			return Response::temporaryRedirect(['for' => 'skill-instance', 'id' => $code]);
		}
	}

	public function delete($code) {
		if (!$this->user->isAdmin()) {
			return Response::forbidden();
		}

		try {
			/** @var Skill $skill */
			$skill = Skill::findFirst($code);
			if (!$skill) {
				return Response::notFound();
			}

			$skill->delete();

			$this->flash->success('Skill successfully deleted!');
			return JsonResponse::ok([
				'location' => $this->url->get(['for' => 'skill-list']),
			]);
		} catch (Exception $e) {
			return JsonResponse::ok([
				'error' => $e->getMessage(),
			]);
		}
	}
}
