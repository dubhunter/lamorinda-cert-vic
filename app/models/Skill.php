<?php

/**
 * @method VolunteerSkill getVolunteerSkill (array $parameters = []) {}
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
			$parameters = [
				'conditions' => 'code = :code:',
				'bind' => [
					'code' => $parameters,
				],
			];
		}
		return parent::findFirst($parameters);
	}

	/**
	 * @param array $parameters
	 * @return self[]
	 */
	public static function find($parameters = []) {
		if (!isset($parameters['order'])) {
			$parameters['order'] = ['code'];
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
