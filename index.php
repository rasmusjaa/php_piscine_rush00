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
			if ($_SESSION['logged_on_user'] && $_SESSION['logged_on_user'] != '')
			{
				echo "Hi " . $_SESSION['logged_on_user'] . "!";
				echo ('
				<div id="login_div">
				');
				if ($_SESSION['user_role'] === "1")
				{
					echo ('
						<a class="button1" style="margin-right: 5px" href="basket.php">Shopping basket</a>
					');
				}
				if ($_SESSION['user_role'] === "0")
				{
					echo ('
						<a class="button1" style="margin-right: 5px" href="admin.php">Admin page</a>
					');
				}
				echo ('
				<a class="button1" style="margin-right: 5px" href="logout.php">Log out</a>
				</div>
				');
			}
			else
			{
				if ($_GET['login'] === 'failed')
					echo "Wrong username or password!";
				echo ('
				<div id="login_div">
				<form style="padding-right: 5px" action="login.php" method="post">
					Username: <input style="padding-right: 5px" type="text" name="login" />
					Password: <input style="padding-right: 5px" type="password" name="passwd" />
					<input style="padding-right: 5px" type="submit" name="submit" value="OK" />
				</form>
				<a class="button1" style="margin-right: 5px" href="create.php">Create an account</a>
				<a class="button1" style="margin-right: 5px" href="modif.php">Change password</a>
				</div>
				');
			}
		?>
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
