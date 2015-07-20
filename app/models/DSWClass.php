<?php

class DSWClass extends Model {

	protected $id;
	protected $class;

	/**
	 * @param array $parameters
	 * @return self[]
	 */
	public static function find($parameters = array()) {
		if (!isset($parameters['order'])) {
			$parameters['order'] = 'class';
		}
		return parent::find($parameters);
	}

	/**
	 * Set the source table and relationships
	 */
	public function initialize() {
		$this->setSource('dsw_classes');
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
	public function getClass() {
		return $this->class;
	}

	/**
	 * @param mixed $class
	 */
	public function setClass($class) {
		$this->class = $class;
	}
}