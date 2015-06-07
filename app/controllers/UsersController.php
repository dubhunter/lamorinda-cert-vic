<?php

use Talon\Response;
use Talon\RestDispatcher;
use Talon\RestRequest;

class UsersController extends SiteController {

	/** @var Owl $user */
	protected $user;

	/**
	 * @param RestDispatcher $dispatcher
	 * @return bool
	 */
	public function beforeExecuteRoute($dispatcher) {
		$auth = $this->session->get('auth');
		if (!$auth) {
			/** @var RestRequest $request */
			$request = $this->request;
			$this->session->set('target', $request->getURI());
			$this->flash->warning('You must login first.');
			$dispatcher->setReturnedValue(Response::temporaryRedirect(array('for' => 'home')));
			return false;
		}
		return true;
	}

	public function	initialize() {
		parent::initialize();

		$auth = $this->session->get('auth');
//		$this->user = Owl::findFirst($auth['guid']);
	}

	protected function getAppGlobal() {
		$twilio = parent::getAppGlobal();
//		$twilio['user'] = array(
//			'guid' => $this->user->getGuid(),
//			'username' => $this->user->getUsername(),
//			'firstName' => $this->user->getFirstName(),
//			'lastName' => $this->user->getLastName(),
//			'displayName' => $this->user->getDisplayName(),
//			'email' => $this->user->getEmail(),
//			'apiKey' => $this->user->getApiKey(),
//			'avatar' => $this->getAvatarUrl($this->user->getGuid()),
//		);
		return $twilio;
	}

}