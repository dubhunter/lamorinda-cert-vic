<?php

use Talon\Http\Response;
use Talon\Http\Response\Json as JsonResponse;

class AgencyRequestListController extends UsersController {

	public function get($agencyId) {
		/** @var Agency $agencyId */
		$agency = Agency::findFirst($agencyId);
		if (!$agency) {
			return Response::notFound();
		}

		$template = $this->getTemplate('data-lists/agency-request-list');

		foreach ($agency->getOpenRequests() as $request) {
			foreach ($request->getOpenRequestDetails() as $requestDetail) {
				$skill = $requestDetail->getSkill();
				$template->add('requestDetails', array(
					'id' => $requestDetail->getId(),
					'requestId' => $requestDetail->getRequestId(),
					'code' => $skill->getCode(),
					'skill' => $skill->getSkill(),
					'number' => $requestDetail->getNumber(),
					'days' => $requestDetail->getDays(),
					'startDate' => $requestDetail->getStartDate(),
					'startTime' => $requestDetail->getStartTime(),
					'hours' => $requestDetail->getNumber(),
					'comment' => $requestDetail->getComment(),
				));
			}
		}

		return Response::ok($template);
	}
}