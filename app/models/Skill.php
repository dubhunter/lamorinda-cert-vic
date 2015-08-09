<?php

/**
 * @method VolunteerSkill getVolunteerSkill (array $parameters = array()) {}
 */
class Skill extends Model {

	protected $code;
	protected $skill;

	/**
	 * @param null|array $parameters
	 * @return self
	 */
	public static function findFirst($parameters = null) {
		if (is_scalar($parameters)) {
			$parameters = array(
				'conditions' => 'code = :code:',
				'bind' => array(
					'code' => $parameters,
				),
			);
		}
		return parent::findFirst($parameters);
	}

	/**
	 * @param array $parameters
	 * @return self[]
	 */
	public static function find($parameters = array()) {
		if (!isset($parameters['order'])) {
			$parameters['order'] = array('code');
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