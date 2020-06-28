<?php

include_once 'orders.php';

$id = $_POST['id'];
$status = $_POST['status'];

if ($id != '' && isset($_POST['remove']) && remove_order($id))
	header('Location: admin.php?order=removed');
else if ($id != '' && $status != '' && modify_order($id, $status))
	header('Location: admin.php?order=modified');
else
	header('Location: admin.php?order=not_modified');
?>
