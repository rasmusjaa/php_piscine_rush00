<?php
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
			<a class="button1" style="margin-right: 5px" href="index.php">Back to Shop</a>
		</div>
	</nav>
	<div id="main_view">
		<div id="form_container">
			<h1>Create a new user</h1>
			<form action="create_user.php" method="post">
			Username: <input type="text" name="login" />
			<br />
			Password: <input type="password" name="passwd" />
			<br />
			<input type="submit" name="submit" value="OK" />
			</form>
			<div id="statusmessage">
				<?php
				if ($_GET['status'] === 'missing')
				{
					echo "Username or password is missing!";
				}
				else if ($_GET['status'] === 'success')
				{
					echo "User created with great success!";
				}
				else if ($_GET['status'] === 'failed')
				{
					echo "Username already exists or username or password is not valid, try again!";
				}
				?>
			</div>
		</div>
	</div>
</body>
</html>
