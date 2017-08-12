<?php
abstract class Person{
	private $id_person;
	private $person_name;
	private $person_email;
	private $person_birth;
	private $person_photo;
	
	public function __construct($person_name){
		$this->person_name = $person_name;
	}
	
	public function get_id_person() {
	    return $this->id_person;
	}
	public function set_id_person($id_person) {
	    $this->id_person = $id_person;
	}
	
	public function get_person_name() {
	    return $this->person_name;
	}
	public function set_person_name($person_name) {
	    $this->person_name = $person_name;
	}
	
	public function get_person_email() {
	    return $this->person_email;
	}
	public function set_person_email($person_email) {
	    $this->person_email = $person_email;
	}

	public function get_person_birth() {
	    return $this->person_birth;
	}
	public function set_person_birth($person_birth) {
	    $this->person_birth = $person_birth;
	}
	
	public function get_person_photo() {
	    return $this->person_photo;
	}
	public function set_person_photo($person_photo) {
	    $this->person_photo = $person_photo;
	}
	
}

?>