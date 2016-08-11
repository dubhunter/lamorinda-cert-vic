<?php

abstract class Model extends \Phalcon\Mvc\Model {
	/**
	 * @param array $data
	 * @param array $whiteList
	 * @return boolean
	 * @throws Exception
	 */
	public function save($data = null, $whiteList = null) {
		$success = parent::save($data, $whiteList);

		if (!$success) {
			foreach ($this->getMessages() as $message) {
				throw new Exception($message);
			}
		}

		return $success;
	}

}
