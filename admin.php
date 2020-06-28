<?php
	session_start();
	if ($_SESSION['user_role'] != "0")
		header('Location: index.php?status=forbidden');
	echo "hi admin";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<link rel="stylesheet" href="styles.css"/>
</head>
<body>
	<div id="main_view">
		<p> sivu tas </p>
	</div>
</body>
</html>
