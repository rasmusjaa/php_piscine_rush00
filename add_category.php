<?php

include_once 'categories.php';

$name = $_POST['name'];

if ($name != '' && add_category($name))
	header('Location: admin.php?category=created');
else
	header('Location: admin.php?category=not_created');
?>
