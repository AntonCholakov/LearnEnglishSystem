<?php

class User
{
	private $id;
	private $username;
	private $password;
	private $email;
	private $role_id;

	function __construct()
	{
		
	}

	public function getId() {
		return $this->id;
	}

	public function getUsername() {
		return $this->username;
	}

	public  function getPassword() {
		return $this->password;
	}
	
	public  function getEmail() {
		return $this->email;
	}
	
	public  function getRoleId() {
		return $this->role_id;
	}

	public function setId($id) {
		$this->id = $id;
	}
	
	public function setUsername($username) {
		$this->username = $username;
	}

	public function setPassword($password) {
		$this->password = $password;
	}

	public  function setEmail($email) {
		$this->email = $email;
	}
	
	public  function setRoleId($role_id) {
		$this->role_id = $role_id;
	}
}