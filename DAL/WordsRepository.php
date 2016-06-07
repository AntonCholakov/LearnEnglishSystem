<?php

require_once '/models/Word.php';

class WordsRepository
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
		$words = $this->getAll();

		foreach ($words as $w) {
			if ($w->getId() == $id) {
				return $w;
			}
		}

		return null;
	}

	function getAll() {
		$result = $this->connection->query("SELECT * FROM `words`");

		$words = array();
		while ($row = $result->fetch_assoc()) {
			$word = new Word();
			$word->setId($row["id"]);
			$word->setBgWord($row["bgword"]);
			$word->setEnWord($row["enword"]);
			$word->setImagePath($row["imagepath"]);
			$word->setComplexityId($row["complexity_id"]);
			$word->setUnitId($row["unit_id"]);

			array_push($words, $word);
		}

		return $words;
	}

	function getAllByUnitId($unitId) {
		$result = $this->connection->query("
SELECT words.`id`, `bgword`, `enword`, `imagepath`, `complexity_id`, `unit_id`
FROM `words`
JOIN `units`
ON words.unit_id = units.id
WHERE units.id = " . $unitId);

		$words = array();
		while ($row = $result->fetch_assoc()) {
			$word = new Word();
			$word->setId($row["id"]);
			$word->setBgWord($row["bgword"]);
			$word->setEnWord($row["enword"]);
			$word->setImagePath($row["imagepath"]);
			$word->setComplexityId($row["complexity_id"]);
			$word->setUnitId($row["unit_id"]);

			array_push($words, $word);
		}

		return $words;
	}

	function getAllByComplexityId($complexityId) {
		$result = $this->connection->query("
SELECT words.`id`, `bgword`, `enword`, `imagepath`, `complexity_id`, `unit_id`
FROM `words`
JOIN `complexities`
ON words.complexity_id = complexities.id
WHERE complexities.id = " . $complexityId);

		$words = array();
		while ($row = $result->fetch_assoc()) {
			$word = new Word();
			$word->setId($row["id"]);
			$word->setBgWord($row["bgword"]);
			$word->setEnWord($row["enword"]);
			$word->setImagePath($row["imagepath"]);
			$word->setComplexityId($row["complexity_id"]);
			$word->setUnitId($row["unit_id"]);

			array_push($words, $word);
		}

		return $words;
	}

	function insert($word) {
		print_r($word);
		$query = "INSERT INTO `words`(`bgword`, `enword`, `imagepath`, `complexity_id`, `unit_id`) VALUES (?,?,?,?,?)";

		$stmt = $this->connection->prepare($query);
		$stmt->bind_param("sssii", $word->getBgWord(), $word->getEnWord(), $word->getImagePath(), $word->getComplexityId(), $word->getUnitId());

		$stmt->execute();
	}

	function update($word) {
		$query = "UPDATE `words` SET bgword=?, enword=?, imagepath=?, complexity_id=?, unit_id=? WHERE id=?";

		$stmt = $this->connection->prepare($query);
		$stmt->bind_param("sssiii", $word->getBgWord(), $word->getEnWord(), $word->getImagePath(), $word->getComplexityId(), $word->getUnitId(), $word->getId());

		$stmt->execute();
	}

	function save($word) {
		if ($word->getId()) {
			$this->update($word);
		}
		else {
			$this->insert($word);
		}
	}

	function delete($id) {
		$query = "DELETE FROM `words` WHERE id=?";
		
		$stmt = $this->connection->prepare($query);
		$stmt->bind_param("i", $id);

		$stmt->execute();
	}

	function getRandom() {
		$result = $this->connection->query("SELECT * FROM `words` ORDER BY RAND() LIMIT 1");

		$word = new Word();
		while ($row = $result->fetch_assoc()) {
			$word->setId($row["id"]);
			$word->setBgWord($row["bgword"]);
			$word->setEnWord($row["enword"]);
			$word->setImagePath($row["imagepath"]);
			$word->setComplexityId($row["complexity_id"]);
			$word->setUnitId($row["unit_id"]);
		}

		return $word;
	}

	function check($word) {
		$wordDB = $this->getById($word->getId());

		if ($wordDB->getEnWord() == $word->getEnWord()) {
			return true;
		}

		return false;
	}
}