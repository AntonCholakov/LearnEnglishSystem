<?php

require_once '/models/Role.php';

class RolesRepository
{
	private $connection;

	public function __construct() {
		$url = 'localhost';
		$dbUsername = 'root';
		$dbPass = '';
		$dbName = 'learn-english';

		$this->connection = new mysqli($url, $dbUsername, $dbPass, $dbName);
		mysqli_set_charset($this->connection, 'utf8');
	}

	function getById($id) {
		$roles = $this->getAll();

		foreach ($roles as $r) {
			if ($r->getId() == $id) {
				return $r;
			}
		}

		return null;
	}

	function getAll() {
		$result = $this->connection->query("SELECT * FROM `roles`");

		$roles = array();
		while ($row = $result->fetch_assoc()) {
			$role = new Role();
			$role->setId($row["id"]);
			$role->setName($row["name"]);

			array_push($roles, $role);
		}

		return $roles;
	}
	
	function insert($role) {
		$query = "INSERT INTO `roles`(`name`) VALUES (?)";

		$stmt = $this->connection->prepare($query);
		$stmt->bind_param("s", $role->getName());

		$stmt->execute();
	}

	function update($role) {
		$query = "UPDATE `roles` SET name=? WHERE id=?";

		$stmt = $this->connection->prepare($query);
		$stmt->bind_param("si", $role->getName(), $role->getId());

		$stmt->execute();
	}

	function save($role) {
		if ($role->getId()) {
			$this->update($role);
		}
		else {
			$this->insert($role);
		}
	}

	function delete($id) {
		$query = "DELETE FROM `roles` WHERE id=?";
		
		$stmt = $this->connection->prepare($query);
		$stmt->bind_param("i", $id);

		$stmt->execute();
	}
}