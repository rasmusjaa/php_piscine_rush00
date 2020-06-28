<?php

include_once 'users.php';
define("ADMIN", "0");
define("USER", "1");

if ($_POST['submit'] !== 'OK' || !$_POST['login'] || !$_POST['passwd'])
{
	header('Location: create.php?status=missing');
}
else
{
	$username = $_POST['login'];
	$password = $_POST['passwd'];
	$role = USER;
	if (add_user($username, $password, $role))
	{
		header('Location: create.php?status=success');
	} else
	{
		header('Location: create.php?status=failed');
	}

}

?>
