<?php

use Dubhunter\Talon\Http\Response;
use Dubhunter\Talon\Http\Response\Image as ImageResponse;

class VolunteerInstanceImageController extends UsersController {

	public function get($id) {
		try {
			/** @var Volunteer $volunteer */
			$volunteer = Volunteer::findFirst($id);
			if (!$volunteer || !$volunteer->getImage()) {
				return Response::notFound();
			}

			$width = $this->request->getQuery('width') ? (int)$this->request->getQuery('width', 'int') : null;
			$height = $this->request->getQuery('height') ? (int)$this->request->getQuery('height', 'int') : null;

			$image = new Image($volunteer->getImage());
			if ($width || $height) {
				$image->resize($width ?: $image->getWidth(), $height ?: $image->getHeight());
			}

			$response = ImageResponse::ok($image);

			return $response;
		} catch (Exception $e) {
			return Response::error($e->getMessage());
		}
	}
}
