<?php

/**
 * @method VolunteerSkill getVolunteerSkill (array $parameters = array()) {}
 */
class Skill extends \Phalcon\Mvc\Model {

	protected $code;
	protected $skill;

	/**
	 * @param array $parameters
	 * @return self[]
	 */
	public static function find($parameters = array()) {
		if (!isset($parameters['order'])) {
			$parameters['order'] = 'code';
		}
		return parent::find($parameters);
	}

	/**
	 * Set the source table and relationships
	 */
	public function initialize() {
		$this->setSource('skills');
		$this->belongsTo('code', 'VolunteerSkill', 'skill_code');
	}

	/**
	 * @return mixed
	 */
	public function getCode() {
		return $this->code;
	}

	/**
	 * @param mixed $code
	 */
	public function setCode($code) {
		$this->code = $code;
	}

	/**
	 * @return mixed
	 */
	public function getSkill() {
		return $this->skill;
	}

	/**
	 * @param mixed $skill
	 */
	public function setSkill($skill) {
		$this->skill = $skill;
	}
}