<?php
	include_once 'products.php';
	include_once 'categories.php';
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<link rel="stylesheet" href="styles.css"/>
</head>
<body>
	<nav>
		<div id="navbar">
		<?php
			echo "Hi " . $_SESSION['logged_on_user'] . "!";
		?>
		<div id="login_div">
			<form style="padding-right: 5px" action="login.php" method="post">
				Username: <input style="padding-right: 5px" type="text" name="login" />
				Password: <input style="padding-right: 5px" type="password" name="passwd" />
				<input style="padding-right: 5px" type="submit" name="submit" value="OK" />
			</form>
			<a class="button1" style="margin-right: 5px" href="create.php">Create an account</a>
			<a class="button1" style="margin-right: 5px" href="modif.php">Change password</a>
			<a class="button1" href="logout.php">Log out</a>
		</div>
		</div>
	</nav>
	<div id="main_view">
		<div id="categories">
		<?php
			get_categories();
		?>
		</div>
	<div id="product_display">
		<?php
			get_products();
		?>
	</div>
	</div>
</body>
</html>
