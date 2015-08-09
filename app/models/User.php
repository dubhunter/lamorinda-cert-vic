<?php

use Talon\Date;

class User extends Model {

	const ROLE_ADMIN = 1;
	const ROLE_USER = 2;

	protected static $roles = array(
		self::ROLE_ADMIN => 'Admin',
		self::ROLE_USER => 'User',
	);

	protected $id;
	protected $username;
	protected $password;
	protected $role;
	protected $date_created;
	protected $date_updated;

	/**
	 * @param string $username
	 * @return self
	 */
	public static function findFirstByUsername($username) {
		$parameters = array(
			'conditions' => 'username = :username:',
			'bind' => array(
				'username' => $username,
			),
		);
		return self::findFirst($parameters);
	}

	/**
	 * @param array $parameters
	 * @return self[]
	 */
	public static function find($parameters = array()) {
		if (!isset($parameters['order'])) {
			$parameters['order'] = array('username');
		}
		return parent::find($parameters);
	}

	/**
	 * @return array
	 */
	public static function getRoles() {
		return self::$roles;
	}

	/**
	 * @param $role
	 * @return string
	 */
	public static function getRoleName($role) {
		return isset(self::$roles[$role]) ? self::$roles[$role] : null;
	}

	/**
	 * Set the source table
	 */
	public function initialize() {
		$this->setSource('users');
	}

	/**
	 * Set on-create properties
	 */
	public function beforeValidationOnCreate() {
		$this->setDateCreated(time());
		$this->setDateUpdated(time());
	}

	/**
	 * Set on-update properties
	 */
	public function beforeValidationOnUpdate() {
		$this->setDateUpdated(time());
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
	public function getUsername() {
		return $this->username;
	}

	/**
	 * @param mixed $username
	 */
	public function setUsername($username) {
		$this->username = $username;
	}

	/**
	 * @return mixed
	 */
	public function getPassword() {
		return $this->password;
	}

	/**
	 * @param mixed $password
	 */
	public function setPassword($password) {
		$this->password = $this->getDI()->get('security')->hash($password);
	}

	/**
	 * @return mixed
	 */
	public function getRole() {
		return $this->role;
	}

	/**
	 * @param mixed $role
	 * @throws Exception
	 */
	public function setRole($role) {
		if (!isset(self::$roles[$role])) {
			throw new Exception('Invalid role (' . $role . ')');
		}
		$this->role = $role;
	}

	/**
	 * @return bool
	 */
	public function isAdmin() {
		return $this->role == self::ROLE_ADMIN;
	}

	/**
	 * @param mixed $date_created
	 */
	public function setDateCreated($date_created) {
		if (is_numeric($date_created)) {
			$date_created = Date::sqlDatetime($date_created);
		}
		$this->date_created = $date_created;
	}

	/**
	 * @return mixed
	 */
	public function getDateCreated() {
		return strtotime($this->date_created);
	}

	/**
	 * @param mixed $date_updated
	 */
	public function setDateUpdated($date_updated) {
		if (is_numeric($date_updated)) {
			$date_updated = Date::sqlDatetime($date_updated);
		}
		$this->date_updated = $date_updated;
	}

	/**
	 * @return mixed
	 */
	public function getDateUpdated() {
		return strtotime($this->date_updated);
	}
}