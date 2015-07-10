<?php

use Talon\Date;

/**
 * @method VolunteerSkill[] getVolunteerSkills (array $parameters = array()) {}
 * @method VolunteerAvailability[] getVolunteerAvailability (array $parameters = array()) {}
 */
class Volunteer extends \Phalcon\Mvc\Model {

	protected $id;
	protected $name_last;
	protected $name_first;
	protected $name_middle;
	protected $address;
	protected $city;
	protected $state;
	protected $zip;
	protected $phone_day;
	protected $phone_eve;
	protected $phone_cell;
	protected $email;
	protected $dob;
	protected $id_type;
	protected $id_number;
	protected $id_state;
	protected $agencies;
	protected $training;
	protected $ec_name;
	protected $ec_phone;
	protected $image;
	protected $intake_by;
	protected $intake_time;
	protected $bg_by;
	protected $bg_time;
	protected $bg_pass;
	protected $screen_by;
	protected $screen_time;
	protected $rev_by;
	protected $rev_time;
	protected $db_by;
	protected $db_time;
	protected $comment;
	protected $available;

	/**
	 * @param array $parameters
	 * @return self[]
	 */
	public static function find($parameters = array()) {
		if (!isset($parameters['order'])) {
			$parameters['order'] = 'name_first, name_last';
		}
		return parent::find($parameters);
	}

	/**
	 * Set the source table and relationships
	 */
	public function initialize() {
		$this->setSource('volunteers');
		$this->hasMany('id', 'VolunteerSkill', 'volunteer_id', array('alias' => 'VolunteerSkills'));
		$this->hasMany('id', 'VolunteerAvailability', 'volunteer_id');
	}

	/**
	 * Set on-create properties
	 */
	public function beforeValidationOnCreate() {
		$this->setDbTime(time());
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
	public function getNameLast() {
		return $this->name_last;
	}

	/**
	 * @param mixed $name_last
	 */
	public function setNameLast($name_last) {
		$this->name_last = $name_last;
	}

	/**
	 * @return mixed
	 */
	public function getNameFirst() {
		return $this->name_first;
	}

	/**
	 * @param mixed $name_first
	 */
	public function setNameFirst($name_first) {
		$this->name_first = $name_first;
	}

	/**
	 * @return mixed
	 */
	public function getNameMiddle() {
		return $this->name_middle;
	}

	/**
	 * @param mixed $name_middle
	 */
	public function setNameMiddle($name_middle) {
		$this->name_middle = $name_middle;
	}

	/**
	 * @return mixed
	 */
	public function getAddress() {
		return $this->address;
	}

	/**
	 * @param mixed $address
	 */
	public function setAddress($address) {
		$this->address = $address;
	}

	/**
	 * @return mixed
	 */
	public function getCity() {
		return $this->city;
	}

	/**
	 * @param mixed $city
	 */
	public function setCity($city) {
		$this->city = $city;
	}

	/**
	 * @return mixed
	 */
	public function getState() {
		return $this->state;
	}

	/**
	 * @param mixed $state
	 */
	public function setState($state) {
		$this->state = $state;
	}

	/**
	 * @return mixed
	 */
	public function getZip() {
		return $this->zip;
	}

	/**
	 * @param mixed $zip
	 */
	public function setZip($zip) {
		$this->zip = $zip;
	}

	/**
	 * @return mixed
	 */
	public function getPhoneDay() {
		return $this->phone_day;
	}

	/**
	 * @param mixed $phone_day
	 */
	public function setPhoneDay($phone_day) {
		$this->phone_day = !empty($phone_day) ? LibPhoneNumber::formatE164($phone_day) : null;
	}

	/**
	 * @return mixed
	 */
	public function getPhoneEve() {
		return $this->phone_eve;
	}

	/**
	 * @param mixed $phone_eve
	 */
	public function setPhoneEve($phone_eve) {
		$this->phone_eve = !empty($phone_eve) ? LibPhoneNumber::formatE164($phone_eve) : null;
	}

	/**
	 * @return mixed
	 */
	public function getPhoneCell() {
		return $this->phone_cell;
	}

	/**
	 * @param mixed $phone_cell
	 */
	public function setPhoneCell($phone_cell) {
		$this->phone_cell = !empty($phone_cell) ? LibPhoneNumber::formatE164($phone_cell) : null;
	}

	/**
	 * @return mixed
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * @param mixed $email
	 */
	public function setEmail($email) {
		$this->email = $email;
	}

	/**
	 * @return mixed
	 */
	public function getDOB() {
		return strtotime($this->dob);
	}

	/**
	 * @param mixed $dob
	 */
	public function setDOB($dob) {
		if (is_numeric($dob)) {
			$dob = Date::sqlDatetime($dob);
		}
		$this->dob = $dob;
	}

	/**
	 * @return mixed
	 */
	public function getIdType() {
		return $this->id_type;
	}

	/**
	 * @param mixed $id_type
	 */
	public function setIdType($id_type) {
		$this->id_type = $id_type;
	}

	/**
	 * @return mixed
	 */
	public function getIdNumber() {
		return $this->id_number;
	}

	/**
	 * @param mixed $id_number
	 */
	public function setIdNumber($id_number) {
		$this->id_number = $id_number;
	}

	/**
	 * @return mixed
	 */
	public function getIdState() {
		return $this->id_state;
	}

	/**
	 * @param mixed $id_state
	 */
	public function setIdState($id_state) {
		$this->id_state = $id_state;
	}

	/**
	 * @return mixed
	 */
	public function getAgencies() {
		return $this->agencies;
	}

	/**
	 * @param mixed $agencies
	 */
	public function setAgencies($agencies) {
		$this->agencies = $agencies;
	}

	/**
	 * @return mixed
	 */
	public function getTraining() {
		return $this->training;
	}

	/**
	 * @param mixed $training
	 */
	public function setTraining($training) {
		$this->training = $training;
	}

	/**
	 * @return mixed
	 */
	public function getEmergencyContactName() {
		return $this->ec_name;
	}

	/**
	 * @param mixed $ec_name
	 */
	public function setEmergencyContactName($ec_name) {
		$this->ec_name = $ec_name;
	}

	/**
	 * @return mixed
	 */
	public function getEmergencyContactPhone() {
		return $this->ec_phone;
	}

	/**
	 * @param mixed $ec_phone
	 */
	public function setEmergencyContactPhone($ec_phone) {
		$this->ec_phone = !empty($ec_phone) ? LibPhoneNumber::formatE164($ec_phone) : null;
	}

	/**
	 * @return mixed
	 */
	public function getImage() {
		return $this->image;
	}

	/**
	 * @param mixed $image
	 */
	public function setImage($image) {
		$this->image = $image;
	}

	/**
	 * @return mixed
	 */
	public function getIntakeBy() {
		return $this->intake_by;
	}

	/**
	 * @param mixed $intake_by
	 */
	public function setIntakeBy($intake_by) {
		$this->intake_by = $intake_by;
	}

	/**
	 * @return mixed
	 */
	public function getIntakeTime() {
		return strtotime($this->intake_time);
	}

	/**
	 * @param mixed $intake_time
	 */
	public function setIntakeTime($intake_time) {
		if (is_numeric($intake_time)) {
			$intake_time = Date::sqlDatetime($intake_time);
		}
		$this->intake_time = $intake_time;
	}

	/**
	 * @return mixed
	 */
	public function getBackgroundBy() {
		return $this->bg_by;
	}

	/**
	 * @param mixed $bg_by
	 */
	public function setBackgroundBy($bg_by) {
		$this->bg_by = $bg_by;
	}

	/**
	 * @return mixed
	 */
	public function getBackgroundTime() {
		return strtotime($this->bg_time);
	}

	/**
	 * @param mixed $bg_time
	 */
	public function setBackgroundTime($bg_time) {
		if (is_numeric($bg_time)) {
			$bg_time = Date::sqlDatetime($bg_time);
		}
		$this->bg_time = $bg_time;
	}

	/**
	 * @return mixed
	 */
	public function getBackgroundPass() {
		return $this->bg_pass == 1;
	}

	/**
	 * @param mixed $bg_pass
	 */
	public function setBackgroundPass($bg_pass) {
		$this->bg_pass = $bg_pass ? 1 : 0;
	}

	/**
	 * @return mixed
	 */
	public function getScreenBy() {
		return $this->screen_by;
	}

	/**
	 * @param mixed $screen_by
	 */
	public function setScreenBy($screen_by) {
		$this->screen_by = $screen_by;
	}

	/**
	 * @return mixed
	 */
	public function getScreenTime() {
		return strtotime($this->screen_time);
	}

	/**
	 * @param mixed $screen_time
	 */
	public function setScreenTime($screen_time) {
		if (is_numeric($screen_time)) {
			$screen_time = Date::sqlDatetime($screen_time);
		}
		$this->screen_time = $screen_time;
	}

	/**
	 * @return mixed
	 */
	public function getReviewBy() {
		return $this->rev_by;
	}

	/**
	 * @param mixed $rev_by
	 */
	public function setReviewBy($rev_by) {
		$this->rev_by = $rev_by;
	}

	/**
	 * @return mixed
	 */
	public function getReviewTime() {
		return strtotime($this->rev_time);
	}

	/**
	 * @param mixed $rev_time
	 */
	public function setReviewTime($rev_time) {
		if (is_numeric($rev_time)) {
			$rev_time = Date::sqlDatetime($rev_time);
		}
		$this->rev_time = $rev_time;
	}

	/**
	 * @return mixed
	 */
	public function getEntryBy() {
		return $this->db_by;
	}

	/**
	 * @param mixed $db_by
	 */
	public function setEntryBy($db_by) {
		$this->db_by = $db_by;
	}

	/**
	 * @return mixed
	 */
	public function getEntryTime() {
		return strtotime($this->db_time);
	}

	/**
	 * @param mixed $db_time
	 */
	public function setEntryTime($db_time) {
		if (is_numeric($db_time)) {
			$db_time = Date::sqlDatetime($db_time);
		}
		$this->db_time = $db_time;
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
	public function getAvailable() {
		return $this->available == 1;
	}

	/**
	 * @param mixed $available
	 */
	public function setAvailable($available) {
		$this->available = $available ? 1 : 0;
	}
}