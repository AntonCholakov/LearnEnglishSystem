<?php
require_once '/DAL/UnitsRepository.php';

$unitsRepository = new UnitsRepository();
$unitsRepository->delete($_GET['id']);

header('Location: units.php');
exit();