<?php
require_once '/DAL/UsersRepository.php';

$usersRepository = new UsersRepository();
$usersRepository->delete($_GET['id']);

header('Location: users.php');
exit();