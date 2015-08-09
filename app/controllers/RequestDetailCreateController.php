<?php

use Talon\Http\Response;
use Talon\Http\Response\Json as JsonResponse;

class RequestDetailCreateController extends UsersController {

	public function get($requestId) {
		/** @var Request $request */
		$request = Request::findFirst($requestId);
		if (!$request) {
			return Response::notFound();
		}

		$template = $this->getTemplate('modals/request-detail-instance');

		$template->set('requestId', $request->getId());

		foreach (Skill::find() as $skill) {
			$template->add('skills', array(
				'code' => $skill->getCode(),
				'skill' => $skill->getSkill(),
			));
		}

		return Response::ok($template);
	}
}