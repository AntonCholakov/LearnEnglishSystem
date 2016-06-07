<?php
require_once '/DAL/WordsRepository.php';

$wordsRepository = new WordsRepository();
$wordsRepository->delete($_GET['id']);

header('Location: words.php');
exit();