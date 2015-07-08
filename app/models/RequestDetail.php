<?php

use Talon\Date;

/**
 * @method Request getRequest (array $parameters = array()) {}
 * @method Skill getSkill (array $parameters = array()) {}
 */
class RequestDetail extends \Phalcon\Mvc\Model {

	protected $id;
	protected $request_id;
	protected $skill_code;
	protected $number;
	protected $days;
	protected $start_date;
	protected $start_time;
	protected $hours;
	protected $comment;
	protected $open;

	/**
	 * @param array $parameters
	 * @return self[]
	 */
	public static function find($parameters = array()) {
		if (!isset($parameters['order'])) {
			$parameters['order'] = 'start_date, start_time';
		}
		return parent::find($parameters);
	}

	/**
	 * Set the source table and relationships
	 */
	public function initialize() {
		$this->setSource('request_details');
		$this->belongsTo('request_id', 'Request', 'id');
		$this->hasOne('skill_code', 'Skill', 'code');
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
	public function getRequestId() {
		return $this->request_id;
	}

	/**
	 * @param mixed $request_id
	 */
	public function setRequestId($request_id) {
		$this->request_id = $request_id;
	}

	/**
	 * @return mixed
	 */
	public function getSkillCode() {
		return $this->skill_code;
	}

	/**
	 * @param mixed $skill_code
	 */
	public function setSkillCode($skill_code) {
		$this->skill_code = $skill_code;
	}

	/**
	 * @return mixed
	 */
	public function getNumber() {
		return $this->number;
	}

	/**
	 * @param mixed $number
	 */
	public function setNumber($number) {
		$this->number = $number;
	}

	/**
	 * @return mixed
	 */
	public function getDays() {
		return $this->days;
	}

	/**
	 * @param mixed $days
	 */
	public function setDays($days) {
		$this->days = $days;
	}

	/**
	 * @return mixed
	 */
	public function getStartDate() {
		return strtotime($this->start_date);
	}

	/**
	 * @param mixed $start_date
	 */
	public function setStartDate($start_date) {
		if (is_numeric($start_date)) {
			$start_date = Date::sqlDate($start_date);
		}
		$this->start_date = $start_date;
	}

	/**
	 * @return mixed
	 */
	public function getStartTime() {
		return strtotime($this->start_time);
	}

	/**
	 * @param mixed $start_time
	 */
	public function setStartTime($start_time) {
		if (is_numeric($start_time)) {
			$start_time = Date::sqlTime($start_time);
		}
		$this->start_time = $start_time;
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
	public function getOpen() {
		return $this->open == 1;
	}

	/**
	 * @param mixed $open
	 */
	public function setOpen($open) {
		$this->open = $open ? 1 : 0;
	}
}