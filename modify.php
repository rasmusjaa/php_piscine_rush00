<?php

include_once 'auth.php';
include_once 'users.php';

if ($_POST['submit'] !== 'OK' || !$_POST['login'] || !$_POST['oldpw']|| !$_POST['newpw'])
	header('Location: modif.php?status=missing');
else
{
	$username = $_POST['login'];
	$password = $_POST['oldpw'];
	$new_password = $_POST['newpw'];
	if (auth($username, $password))
	{
		change_user_password($username, $new_password);
		header('Location: modif.php?status=success');
	}
	else
	{
		header('Location: modif.php?status=failed');
	}
}

?>
