<?php

require_once '/models/Complexity.php';

class ComplexitiesRepository
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
		$complexities = $this->getAll();

		foreach ($complexities as $c) {
			if ($c->getId() == $id) {
				return $c;
			}
		}

		return null;
	}

	function getAll() {
		$result = $this->connection->query("SELECT * FROM `complexities`");

		$complexities = array();
		while ($row = $result->fetch_assoc()) {
			$complexity = new Complexity();
			$complexity->setId($row["id"]);
			$complexity->setName($row["name"]);

			array_push($complexities, $complexity);
		}

		return $complexities;
	}

	function insert($complexity) {
		$query = "INSERT INTO `complexities`(`name`) VALUES (?)";

		$stmt = $this->connection->prepare($query);
		$stmt->bind_param("s", $complexity->getName());

		$stmt->execute();
	}

	function update($complexity) {
		$query = "UPDATE `complexities` SET name=? WHERE id=?";

		$stmt = $this->connection->prepare($query);
		$stmt->bind_param("si", $complexity->getName(), $complexity->getId());

		$stmt->execute();
	}

	function save($complexity) {
		if ($complexity->getId()) {
			$this->update($complexity);
		}
		else {
			$this->insert($complexity);
		}
	}

	function delete($id) {
		$query = "DELETE FROM `complexities` WHERE id=?";
		
		$stmt = $this->connection->prepare($query);
		$stmt->bind_param("i", $id);

		$stmt->execute();
	}
}