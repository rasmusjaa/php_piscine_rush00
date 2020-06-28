<?php

include_once 'categories.php';

$name = $_POST['name'];
$newname = $_POST['newname'];

if ($name != '' && isset($_POST['remove']) && remove_category($name))
	header('Location: admin.php?category=removed');
else if ($name != '' && $newname != '' && rename_category($name, $newname))
	header('Location: admin.php?category=modified');
else
	header('Location: admin.php?category=not_modified');
?>
