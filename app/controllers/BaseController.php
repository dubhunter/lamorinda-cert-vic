<?php

use Dubhunter\Talon\Http\RestRequest;
use Dubhunter\Talon\Mvc\RestController;
use Dubhunter\Talon\Mvc\View\Template;

class BaseController extends RestController {

	const URL_EXPIRY = 86400;
	const TOKEN_EXPIRY = 3600;
	const ASSET_CACHE_DIR = 'assets/cache/';

	/**
	 * @param bool $includeHost
	 * @param bool $includePath
	 * @return string
	 */
	protected function getUrl($includeHost = false, $includePath = false) {
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

	protected function saveValues() {
		$this->session->set('values', $this->request->get(null, 'string'));
	}

	/**
	 * @return array
	 */
	protected function getAppGlobal() {
		if ($this->session->has('values')) {
			$values = $this->session->get('values');
			$this->session->remove('values');
		} else {
			$values = $this->request->get(null, 'string');
		}
		$app = [
			'url' => $this->getUrl(false, true),
			'values' => $values,
		];
		return $app;
	}

	/**
	 * @param string $filename
	 * @return Template
	 */
	protected function getTemplate($filename) {
		$template = parent::getTemplate($filename);
		$template->set('app', $this->getAppGlobal());
		return $template;
	}

}
