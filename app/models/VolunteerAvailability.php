<?php

use Dubhunter\Talon\Date;
use Dubhunter\Talon\Time;

/**
 * @method Volunteer getVolunteer (array $parameters = []) {}
 */
class VolunteerAvailability extends Model {

	protected $id;
	protected $volunteer_id;
	protected $date;
	protected $start;
	protected $end;
	protected $comment;
	protected $open;

	/**
	 * @param array $parameters
	 * @return self[]
	 */
	public static function find($parameters = []) {
		if (!isset($parameters['order'])) {
			$parameters['order'] = ['date', 'start', 'end'];
		}
		return parent::find($parameters);
	}

	/**
	 * Set the source table and relationships
	 */
	public function initialize() {
		$this->setSource('volunteer_availability');
		$this->belongsTo('volunteer_id', 'Volunteer', 'id');
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
	public function getStart() {
		return Time::time($this->start);
	}

	/**
	 * @param mixed $start
	 */
	public function setStart($start) {
		if (is_numeric($start)) {
			$start = Date::sqlTime($start);
		}
		$this->start = $start;
	}

	/**
	 * @return mixed
	 */
	public function getEnd() {
		return Time::time($this->end);
	}

	/**
	 * @param mixed $end
	 */
	public function setEnd($end) {
		if (is_numeric($end)) {
			$end = Date::sqlTime($end);
		}
		$this->end = $end;
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
