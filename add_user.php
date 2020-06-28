<?php

include_once 'users.php';

$username = $_POST['name'];
$password = $_POST['password'];
$role = $_POST['role'];

if ($username != '' && $password != '' && add_user($username, $password, $role))
	header('Location: admin.php?user=created');
else
	header('Location: admin.php?user=not_created');
?>
