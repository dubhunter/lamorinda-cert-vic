<?php

use Talon\Date;

/**
 * @method Volunteer getVolunteer (array $parameters = array()) {}
 * @method RequestDetail getRequestDetail (array $parameters = array()) {}
 */
class Timesheet extends \Phalcon\Mvc\Model {

	protected $id;
	protected $volunteer_id;
	protected $request_details_id;
	protected $comment;
	protected $date;
	protected $hours;

	/**
	 * @param array $parameters
	 * @return self[]
	 */
	public static function find($parameters = array()) {
		if (!isset($parameters['order'])) {
			$parameters['order'] = 'date';
		}
		return parent::find($parameters);
	}

	/**
	 * Set the source table and relationships
	 */
	public function initialize() {
		$this->setSource('timesheets');
		$this->belongsTo('volunteer_id', 'Volunteer', 'id');
		$this->belongsTo('request_detail_id', 'RequestDetail', 'id');
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
	public function getRequestDetailsId() {
		return $this->request_details_id;
	}

	/**
	 * @param mixed $request_details_id
	 */
	public function setRequestDetailsId($request_details_id) {
		$this->request_details_id = $request_details_id;
	}

	/**
	 * @return mixed
	 */
	public function getComment() {
		return $this->comment;
	}

	/**
	 * @param mixed $comment
	 */
	public function setComment($comment) {
		$this->comment = $comment;
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
			Date::sqlDate($date);
		}
		$this->date = $date;
	}

	/**
	 * @return mixed
	 */
	public function getHours() {
		return $this->hours;
	}

	/**
	 * @param mixed $hours
	 */
	public function setHours($hours) {
		$this->hours = $hours;
	}
}