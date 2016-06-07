<?php
if(!isset($_SESSION['LoggedUserId'])) {
    if ($_SERVER['PHP_SELF'] != '/learn-english/login.php'
        && $_SERVER['PHP_SELF'] != '/learn-english/register.php') {
        header('Location: login.php');
        exit();
    }
}