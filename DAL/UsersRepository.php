<?php

require_once '/models/User.php';

class UsersRepository
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
		$users = $this->getAll();

		foreach ($users as $u) {
			if ($u->getId() == $id) {
				return $u;
			}
		}

		return null;
	}

	function getByUsernameAndPassword($username, $password) {
		$users = $this->getAll();

		foreach ($users as $u) {
			if ($u->getUsername() == $username && $u->getPassword() == $password) {
				return $u;
			}
		}

		return null;
	}

	function getAll() {
		$result = $this->connection->query("SELECT * FROM `users`");

		$users = array();
		while ($row = $result->fetch_assoc()) {
			$user = new User();
			$user->setId($row["id"]);
			$user->setUsername($row["username"]);
			$user->setPassword($row["password"]);
			$user->setEmail($row["email"]);
			$user->setRoleId($row["role_id"]);

			array_push($users, $user);
		}

		return $users;
	}

	function getAllByRoleId($roleId) {
		$result = $this->connection->query("
SELECT users.`id`, `username`, `password`, `email`, `role_id` 
FROM `users`
JOIN `roles`
ON users.role_id = roles.id
WHERE roles.id = " . $roleId);

		$users = array();
		while ($row = $result->fetch_assoc()) {
			$user = new User();
			$user->setId($row["id"]);
			$user->setUsername($row["username"]);
			$user->setPassword($row["password"]);
			$user->setEmail($row["email"]);
			$user->setRoleId($row["role_id"]);

			array_push($users, $user);
		}

		return $users;
	}


	function insert($user) {
		$query = "INSERT INTO `users`(`username`, `password`, `email`, `role_id`) VALUES (?,?,?,?)";

		$stmt = $this->connection->prepare($query);
		$stmt->bind_param("sssi", $user->getUsername(), $user->getPassword(), $user->getEmail(), $user->getRoleId());

		$stmt->execute();
	}

	function update($user) {
		$query = "UPDATE `users` SET username=?, password=?, email=?, role_id=? WHERE id=?";

		$stmt = $this->connection->prepare($query);
		$stmt->bind_param("ssssi", $user->getUsername(), $user->getPassword(), $user->getEmail(), $user->getRoleId(), $user->getId());

		$stmt->execute();
	}

	function save($user) {
		if ($user->getId()) {
			$this->update($user);
		}
		else {
			$this->insert($user);
		}
	}

	function delete($id) {
		$query = "DELETE FROM `users` WHERE id=?";
		
		$stmt = $this->connection->prepare($query);
		$stmt->bind_param("i", $id);

		$stmt->execute();
	}
}