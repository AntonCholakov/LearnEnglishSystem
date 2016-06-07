<?php
	session_start();
	require_once '/filters/authorisation_filter.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Learn English</title>

	<!--Import Google Icon Font-->
	<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

	<!--Import materialize.css-->
	<link type="text/css" rel="stylesheet" href="styles/materialize.min.css"  media="screen,projection"/>

	<!--Let browser know website is optimized for mobile-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

	<link rel="stylesheet" href="styles/styles.css">
</head>
<body>
<div class="container-fluid">
	<header>
		<nav>
			<ul>
				<li><a href="users.php">Users</a></li>
				<li><a href="roles.php">Roles</a></li>
				<li><a href="words.php">Words</a></li>
				<li><a href="units.php">Units</a></li>
				<li><a href="complexities.php">Complexities</a></li>
			</ul>
			<?php require_once '/partials/login_panel.php' ?>
		</nav>
	</header>
</div>
<div class="container">
