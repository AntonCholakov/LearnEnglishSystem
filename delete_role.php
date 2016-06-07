<?php
require_once '/DAL/RolesRepository.php';

$rolesRepository = new RolesRepository();
$rolesRepository->delete($_GET['id']);

header('Location: roles.php');
exit();