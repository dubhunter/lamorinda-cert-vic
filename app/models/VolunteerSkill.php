<?php

use Dubhunter\Talon\Date;

/**
 * @method Volunteer getVolunteer (array $parameters = []) {}
 * @method Skill getSkill (array $parameters = []) {}
 */
class VolunteerSkill extends Model {

	protected $id;
	protected $volunteer_id;
	protected $skill_code;
	protected $check;
	protected $license;
	protected $license_auth;
	protected $license_exp;
	protected $specialty;
	protected $comment;

	/**
	 * @param array $parameters
	 * @return self[]
	 */
	public static function find($parameters = []) {
		if (!isset($parameters['order'])) {
			$parameters['order'] = ['skill_code'];
		}
		return parent::find($parameters);
	}

	/**
	 * Set the source table and relationships
	 */
	public function initialize() {
		$this->setSource('volunteer_skills');
		$this->belongsTo('volunteer_id', 'Volunteer', 'id');
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
	public function getCheck() {
		return $this->check == 1;
	}

	/**
	 * @param mixed $check
	 */
	public function setCheck($check) {
		$this->check = $check ? 1 : 0;
	}

	/**
	 * @return mixed
	 */
	public function getLicense() {
		return $this->license;
	}

	/**
	 * @param mixed $license
	 */
	public function setLicense($license) {
		$this->license = $license;
	}

	/**
	 * @return mixed
	 */
	public function getLicenseAuth() {
		return $this->license_auth;
	}

	/**
	 * @param mixed $license_auth
	 */
	public function setLicenseAuth($license_auth) {
		$this->license_auth = $license_auth;
	}

	/**
	 * @return mixed
	 */
	public function getLicenseExp() {
		return strtotime($this->license_exp);
	}

	/**
	 * @param mixed $license_exp
	 */
	public function setLicenseExp($license_exp) {
		if (is_numeric($license_exp)) {
			$license_exp = Date::sqlDate($license_exp);
		}
		$this->license_exp = $license_exp;
	}

	/**
	 * @return mixed
	 */
	public function getSpecialty() {
		return $this->specialty;
	}

	/**
	 * @param mixed $specialty
	 */
	public function setSpecialty($specialty) {
		$this->specialty = $specialty;
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
}
