<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
</head>
<body>
	<form action="modify.php" method="post">
	Username: <input type="text" name="login" />
	<br />
	Old password: <input type="password" name="oldpw" />
	<br />
	New password: <input type="password" name="newpw" />
	<br />
	<input type="submit" name="submit" value="OK" />
	</form>
	<div id="statusmessage">
		<?php
		if ($_GET['status'] === 'missing')
		{
			echo "Username or one of the passwords is missing!";
		}
		else if ($_GET['status'] === 'success')
		{
			echo "Password changed with great success!";
		}
		else if ($_GET['status'] === 'failed')
		{
			echo "Username and old password combination not found, try again!";
		}
		?>
	</div>
</body>
</html>
