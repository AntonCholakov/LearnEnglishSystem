<?php
require_once '/DAL/WordsRepository.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') :
	$wordsRepo = new WordsRepository();
	$word = new Word();
	$word->setId(htmlspecialchars(trim($_POST['id'])));
	$word->setBgWord(htmlspecialchars(trim($_POST['bgword'])));
	$word->setEnWord(htmlspecialchars(trim($_POST['enword'])));

	$result = $wordsRepo->check($word);

	$redirect = htmlspecialchars(trim($_POST['redirect']));

	if ($result) {
		header('Location: ' . $redirect . '.php');
	}
	else {
		session_start();
		$_SESSION['error'] = "Wrong! Try again!";
		header('Location: ' . $redirect . '.php?id=' . $word->getId());
	}

endif;