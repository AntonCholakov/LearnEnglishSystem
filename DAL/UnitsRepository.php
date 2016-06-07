<?php

require_once '/models/Unit.php';

class UnitsRepository
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
		$units = $this->getAll();

		foreach ($units as $u) {
			if ($u->getId() == $id) {
				return $u;
			}
		}

		return null;
	}

	function getAll() {
		$result = $this->connection->query("SELECT * FROM `units`");

		$units = array();
		while ($row = $result->fetch_assoc()) {
			$unit = new Unit();
			$unit->setId($row["id"]);
			$unit->setName($row["name"]);

			array_push($units, $unit);
		}

		return $units;
	}

	function insert($unit) {
		$query = "INSERT INTO `units`(`name`) VALUES (?)";

		$stmt = $this->connection->prepare($query);
		$stmt->bind_param("s", $unit->getName());

		$stmt->execute();
	}

	function update($unit) {
		$query = "UPDATE `units` SET name=? WHERE id=?";

		$stmt = $this->connection->prepare($query);
		$stmt->bind_param("si", $unit->getName(), $unit->getId());

		$stmt->execute();
	}

	function save($unit) {
		if ($unit->getId()) {
			$this->update($unit);
		}
		else {
			$this->insert($unit);
		}
	}

	function delete($id) {
		$query = "DELETE FROM `units` WHERE id=?";
		
		$stmt = $this->connection->prepare($query);
		$stmt->bind_param("i", $id);

		$stmt->execute();
	}
}