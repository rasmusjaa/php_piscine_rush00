<?php

session_start();

if ($_SESSION['logged_on_user'])
	$_SESSION['logged_on_user'] = '';
$_SESSION['user_role'] = "-1";
header('Location: index.php');

?>
