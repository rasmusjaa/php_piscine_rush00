<?php

include_once 'users.php';

$username = $_POST['name'];
$role = $_POST['role'];

if ($username != '' && isset($_POST['remove']) && remove_user($username))
	header('Location: admin.php?user=removed');
else if ($username != '' && modify_user($username, $role))
	header('Location: admin.php?user=modified');
else
	header('Location: admin.php?user=not_modified');
?>
