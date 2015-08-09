<?php

class Agency extends Model {

	protected $id;
	protected $name;
	protected $street;
	protected $city;
	protected $phone;
	protected $contact;
	protected $position;
	protected $phone_direct;
	protected $fax;
	protected $phone_cell;
	protected $email;
	protected $radio;
	protected $comment;

	/**
	 * @param null|array $parameters
	 * @return self
	 */
	public static function findFirst($parameters = null) {
		if (is_scalar($parameters)) {
			$parameters = array(
				'conditions' => 'id = :id:',
				'bind' => array(
					'id' => $parameters,
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
			$parameters['order'] = array('name');
		}
		return parent::find($parameters);
	}

	/**
	 * @return mixed
	 */
	public static function countOpenRequests() {
		$parameters['distinct'] = 'agency_id';
		return Request::countOpen($parameters);
	}

	/**
	 * Set the source table and relationships
	 */
	public function initialize() {
		$this->setSource('agencies');
	}

	/**
	 * @param array $parameters
	 * @return Request[]
	 */
	public function getOpenRequests($parameters = array()) {
		$parameters['conditions'] = 'agency_id = :agency_id: AND open = 1';
		$parameters['bind'] = array(
			'agency_id' => $this->id,
		);
		return Request::find($parameters);
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
	public function getName() {
		return $this->name;
	}

	/**
	 * @param mixed $name
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * @return mixed
	 */
	public function getStreet() {
		return $this->street;
	}

	/**
	 * @param mixed $street
	 */
	public function setStreet($street) {
		$this->street = $street;
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
	public function getPhone() {
		return $this->phone;
	}

	/**
	 * @param mixed $phone
	 */
	public function setPhone($phone) {
		$this->phone = !empty($phone) ? LibPhoneNumber::formatE164($phone) : null;
	}

	/**
	 * @return mixed
	 */
	public function getContact() {
		return $this->contact;
	}

	/**
	 * @param mixed $contact
	 */
	public function setContact($contact) {
		$this->contact = $contact;
	}

	/**
	 * @return mixed
	 */
	public function getPosition() {
		return $this->position;
	}

	/**
	 * @param mixed $position
	 */
	public function setPosition($position) {
		$this->position = $position;
	}

	/**
	 * @return mixed
	 */
	public function getPhoneDirect() {
		return $this->phone_direct;
	}

	/**
	 * @param mixed $phone_direct
	 */
	public function setPhoneDirect($phone_direct) {
		$this->phone_direct = !empty($phone_direct) ? LibPhoneNumber::formatE164($phone_direct) : null;
	}

	/**
	 * @return mixed
	 */
	public function getFax() {
		return $this->fax;
	}

	/**
	 * @param mixed $fax
	 */
	public function setFax($fax) {
		$this->fax = !empty($fax) ? LibPhoneNumber::formatE164($fax) : null;
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
	public function getRadio() {
		return $this->radio;
	}

	/**
	 * @param mixed $radio
	 */
	public function setRadio($radio) {
		$this->radio = $radio;
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