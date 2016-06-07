<?php
require_once '/DAL/ComplexitiesRepository.php';

$complexitiesRepository = new ComplexitiesRepository();
$complexitiesRepository->delete($_GET['id']);

header('Location: complexities.php');
exit();