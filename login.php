<?php

session_start();
include_once 'auth.php';
include_once 'users.php';

if (!$_POST['login'] || !$_POST['passwd'])
	header('Location: index.php?login=failed');

$username = $_POST['login'];
$password = $_POST['passwd'];
if (auth($username, $password))
{
	$_SESSION['logged_on_user'] = $_POST['login'];
	$_SESSION['user_role'] = get_user_role($username);
	header('Location: index.php?login=success');
}
else
{
	$_SESSION['logged_on_user'] = '';
	header('Location: index.php?login=failed');
}

?>
