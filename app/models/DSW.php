<?php

use Talon\Date;

/**
 * @method Volunteer getVolunteer (array $parameters = array()) {}
 * @method DSWClass getDswClass (array $parameters = array()) {}
 * @method Jurisdiction getJurisdiction (array $parameters = array()) {}
 */
class DSW extends Model {

	protected $id;
	protected $volunteer_id;
	protected $dsw_class_id;
	protected $jurisdiction_id;
	protected $date;
	protected $sworn_by;

	/**
	 * @param array $parameters
	 * @return self[]
	 */
	public static function find($parameters = array()) {
		if (!isset($parameters['order'])) {
			$parameters['order'] = array('date');
		}
		return parent::find($parameters);
	}

	/**
	 * Set the source table and relationships
	 */
	public function initialize() {
		$this->setSource('dsw');
		$this->belongsTo('volunteer_id', 'Volunteer', 'id');
		$this->belongsTo('dsw_class_id', 'DSWClass', 'id');
		$this->belongsTo('jurisdiction_id', 'Jurisdiction', 'id');
	}

	/**
	 * Set on-create properties
	 */
	public function beforeValidationOnCreate() {
		if (!$this->getDate()) {
			$this->setDate(time());
		}
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
	public function getVolunteerId() {
		return $this->volunteer_id;
	}

	/**
	 * @param mixed $volunteer_id
	 */
	public function setVolunteerId($volunteer_id) {
		$this->volunteer_id = $volunteer_id;
	}

	/**
	 * @return mixed
	 */
	public function getDswClassId() {
		return $this->dsw_class_id;
	}

	/**
	 * @param mixed $dsw_class_id
	 */
	public function setDswClassId($dsw_class_id) {
		$this->dsw_class_id = $dsw_class_id;
	}

	/**
	 * @return mixed
	 */
	public function getJurisdictionId() {
		return $this->jurisdiction_id;
	}

	/**
	 * @param mixed $jurisdiction_id
	 */
	public function setJurisdictionId($jurisdiction_id) {
		$this->jurisdiction_id = $jurisdiction_id;
	}

	/**
	 * @return mixed
	 */
	public function getDate() {
		return strtotime($this->date);
	}

	/**
	 * @param mixed $date
	 */
	public function setDate($date) {
		if (is_numeric($date)) {
			$date = Date::sqlDate($date);
		}
		$this->date = $date;
	}

	/**
	 * @return mixed
	 */
	public function getSwornBy() {
		return $this->sworn_by;
	}

	/**
	 * @param mixed $sworn_by
	 */
	public function setSwornBy($sworn_by) {
		$this->sworn_by = $sworn_by;
	}
}