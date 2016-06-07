<?php
if(!isset($_SESSION['LoggedUserIsAdmin'])) {
    header('Location: index.php');
    exit();
}