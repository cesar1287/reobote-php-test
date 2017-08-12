<?php
include_once 'Person.class.php';
	
class User extends Person{
	private $user_password;
	
	public function __construct($person_name, $person_email, $user_password){
		parent::__construct($person_name);
		parent::set_person_email($person_email);
		$this->user_password = $user_password;
	}
	
	public function get_user_password() {
	    return $this->user_password;
	}
	public function set_user_password($user_password) {
	    $this->user_password = $user_password;
	}
	
}