<?php

use Talon\Http\Response;
use Talon\Http\Response\Json as JsonResponse;

class RequestDetailInstanceController extends UsersController {

	public function get($requestId, $id) {
		/** @var Request $request */
		$request = Request::findFirst($requestId);
		if (!$request) {
			return Response::notFound();
		}
		/** @var RequestDetail $requestDetail */
		$requestDetail = RequestDetail::findFirst($id);
		if (!$requestDetail) {
			return Response::notFound();
		}
		if ($request->getId() != $requestDetail->getRequestId()) {
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

		$template->set('requestDetail', array(
			'id' => $requestDetail->getId(),
			'skillCode' => $requestDetail->getSkillCode(),
			'number' => $requestDetail->getNumber(),
			'days' => $requestDetail->getDays(),
			'startDate' => $requestDetail->getStartDate(),
			'startTime' => $requestDetail->getStartTime(),
			'hours' => $requestDetail->getNumber(),
			'comment' => $requestDetail->getComment(),
			'open' => $requestDetail->getOpen(),
		));

		return Response::ok($template);
	}

	public function post($requestId, $id) {
		try {
//			if (!$this->security->checkToken()) {
//				throw new Exception('Something went wrong. Please try again.');
//			}

			/** @var Request $request */
			$request = Request::findFirst($requestId);
			if (!$request) {
				return Response::notFound();
			}
			/** @var RequestDetail $requestDetail */
			$requestDetail = RequestDetail::findFirst($id);
			if (!$requestDetail) {
				return Response::notFound();
			}
			if ($request->getId() != $requestDetail->getRequestId()) {
				return Response::notFound();
			}

			if ($this->request->hasPost('skillCode')) {
				$requestDetail->setSkillCode($this->request->getPost('skillCode', 'string'));
			}
			if ($this->request->hasPost('number')) {
				$requestDetail->setNumber($this->request->getPost('number', 'int'));
			}
			if ($this->request->hasPost('days')) {
				$requestDetail->setDays($this->request->getPost('days', 'int'));
			}
			if ($this->request->hasPost('startDate')) {
				$requestDetail->setStartDate($this->request->getPost('startDate', 'date'));
			}
			if ($this->request->hasPost('startTime')) {
				$requestDetail->setStartTime($this->request->getPost('startTime', 'time'));
			}
			if ($this->request->hasPost('hours')) {
				$requestDetail->setHours($this->request->getPost('hours', 'int'));
			}
			if ($this->request->hasPost('comment')) {
				$requestDetail->setComment($this->request->getPost('comment', 'string'));
			}
			$requestDetail->setOpen($this->request->getPost('open', 'int'));
			$requestDetail->save();

			return JsonResponse::ok(array(
				'success' => 'Request detail successfully saved!',
			));
		} catch (Exception $e) {
			return JsonResponse::ok(array(
				'error' => $e->getMessage(),
			));
		}
	}
}