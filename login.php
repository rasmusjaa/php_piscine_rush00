<?php

session_start();
include_once 'auth.php';

if (!$_POST['login'] || !$_POST['passwd'])
	header('Location: index.php?login=failed');

$username = $_POST['login'];
$password = $_POST['passwd'];
if (auth($username, $password))
{
	$_SESSION['logged_on_user'] = $_POST['login'];
	header('Location: index.php?login=success');
}
else
{
	$_SESSION['logged_on_user'] = '';
	header('Location: index.php?login=failed');
}

?>
