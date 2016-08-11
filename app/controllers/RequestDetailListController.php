<?php

use Dubhunter\Talon\Http\Response;
use Dubhunter\Talon\Http\Response\Json as JsonResponse;

class RequestDetailListController extends UsersController {

	public function get($requestId) {
		/** @var Request $request */
		$request = Request::findFirst($requestId);
		if (!$request) {
			return Response::notFound();
		}

		$template = $this->getTemplate('data-lists/request-detail-list');

		$template->set('requestId', $request->getId());

		foreach ($request->getRequestDetails() as $requestDetail) {
			$skill = $requestDetail->getSkill();
			$template->add('requestDetails', [
				'id' => $requestDetail->getId(),
				'code' => $skill->getCode(),
				'skill' => $skill->getSkill(),
				'number' => $requestDetail->getNumber(),
				'days' => $requestDetail->getDays(),
				'startDate' => $requestDetail->getStartDate(),
				'startTime' => $requestDetail->getStartTime(),
				'hours' => $requestDetail->getNumber(),
				'comment' => $requestDetail->getComment(),
				'open' => $requestDetail->getOpen(),
			]);
		}

		return Response::ok($template);
	}

	public function post($requestId) {
		try {
//			if (!$this->security->checkToken()) {
//				throw new Exception('Something went wrong. Please try again.');
//			}

			/** @var Request $request */
			$request = Request::findFirst($requestId);
			if (!$request) {
				return Response::notFound();
			}

			$requestDetail = new RequestDetail();

			$requestDetail->setRequestId($request->getId());
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

			return JsonResponse::ok([
				'success' => 'Request detail successfully saved!',
			]);
		} catch (Exception $e) {
			return JsonResponse::ok([
				'error' => $e->getMessage(),
			]);
		}
	}
}
