<?php

use Talon\Http\Response;
use Talon\Http\Response\Json as JsonResponse;
use Talon\Http\RestRequest;
use Talon\Mvc\View\Template;

class BaseController extends Phalcon\Mvc\Controller {

	const URL_EXPIRY = 86400;
	const TOKEN_EXPIRY = 3600;
	const ASSET_CACHE_DIR = 'assets/cache/';

	public function options() {
		return $this->request->isAjax() ? JsonResponse::methodNotAllowed() : Response::methodNotAllowed();
	}

	public function head() {
		return $this->request->isAjax() ? JsonResponse::methodNotAllowed() : Response::methodNotAllowed();
	}

	public function get() {
		return $this->request->isAjax() ? JsonResponse::methodNotAllowed() : Response::methodNotAllowed();
	}

	public function post() {
		return $this->request->isAjax() ? JsonResponse::methodNotAllowed() : Response::methodNotAllowed();
	}

	public function put() {
		return $this->request->isAjax() ? JsonResponse::methodNotAllowed() : Response::methodNotAllowed();
	}

	public function delete() {
		return $this->request->isAjax() ? JsonResponse::methodNotAllowed() : Response::methodNotAllowed();
	}

	/**
	 * @param bool $includeHost
	 * @param bool $includePath
	 * @return string
	 */
	protected function getUrl($includeHost = false ,$includePath = false) {
		$url = '';
		if ($includeHost) {
			$url .= $this->request->getScheme() . '://' . $this->request->getHttpHost();
		}
		if ($includePath) {
			/** @var RestRequest $request */
			$request = $this->request;
			$url .= $request->getURI();
		}
		return $url;
	}

	/**
	 * @param $url
	 * @param $params
	 * @return string
	 */
	protected function buildUrl($url, $params) {
		return http_build_url($url, array('query' => http_build_query($params)));
	}

	/**
	 * @return array
	 */
	protected function getAppGlobal() {
		$twilio = array(
			'url' => $this->getUrl(false, true),
			'values' => $this->request->get(null, 'string'),
		);
		return $twilio;
	}

	/**
	 * @param string $filename
	 * @return Template
	 */
	protected function getTemplate($filename) {
		$template = new Template($this->view, $filename);
		$template->set('app', $this->getAppGlobal());
		return $template;
	}

}