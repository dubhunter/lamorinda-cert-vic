<?php

class Jurisdiction extends Model {

	protected $id;
	protected $jurisdiction;

	/**
	 * @param array $parameters
	 * @return self[]
	 */
	public static function find($parameters = array()) {
		if (!isset($parameters['order'])) {
			$parameters['order'] = 'jurisdiction';
		}
		return parent::find($parameters);
	}

	/**
	 * Set the source table and relationships
	 */
	public function initialize() {
		$this->setSource('jurisdictions');
	}

	/**
	 * @return mixed
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @param mixed $id
	 */
	public function setId($id) {
		$this->id = $id;
	}

	/**
	 * @return mixed
	 */
	public function getJurisdiction() {
		return $this->jurisdiction;
	}

	/**
	 * @param mixed $jurisdiction
	 */
	public function setJurisdiction($jurisdiction) {
		$this->jurisdiction = $jurisdiction;
	}
}