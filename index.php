<?php
	include_once 'products.php';
	include_once 'categories.php';
	session_start();
	if (!$_SESSION['basket'])
		$_SESSION['basket'] = null;
	if (!$_SESSION['filter']) {
		$_SESSION['filter'] = '';
	}

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
				echo "<p style='margin: 10px;'>Hi " . $_SESSION['logged_on_user'] . "!</p?>";
				echo ('
				<div id="login_div">
				');
				echo ('
				<a class="button1" style="margin-right: 5px" href="logout.php">Log out</a>
				</div>
				');
			}
			else
			{
				if ($_GET['login'] === 'failed')
					echo "<p style='margin: 10px;'>Wrong username or password!</p>";
				echo ('
				<div id="login_div">
					<form style="margin: 0px 10px;" action="login.php" method="post">
						Username: <input style="padding-right: 5px" type="text" name="login" />
						Password: <input style="padding-right: 5px" type="password" name="passwd" />
						<input type="submit" name="submit" value="Login" />
					</form>
					<div id="buttons">
						<a class="button1" style="margin-right: 5px" href="create.php">Create an account</a>
						<a class="button1" style="margin-right: 5px" href="modif.php">Change password</a>
					</div>
				</div>
				');
			}
		?>
		</div>
	</nav>
	<div id="top">
		<h1>Balls & Frisbees</h1>
		<?php
			echo '<h2>'.$_SESSION['filter'].'</h2>';
			if ($_SESSION['user_role'] != "0")
			{
				echo ('
					<a class="button1" style="margin-right: 5px" href="basket.php">Shopping basket</a>
				');
			}
			if ($_SESSION['user_role'] === "0")
			{
				echo ('
					<a class="button1" style="margin-right: 5px; margin-bottom: 5px;" href="basket.php">Shopping basket</a>
					<a class="button1" style="margin-right: 5px;" href="admin.php">Admin page</a>
				');
			}
		?>
	</div>
	<div id="main_view">
		<div id="categories">
		<?php
			$categories = get_categories();
			echo '<form class="category" method="get" action="filter.php">
			<input type="submit" name="category" value="all categories" class="category_name">'.
			'</input></form>';
			foreach ($categories as $category) {
				echo '<form class="category" method="get" action="filter.php">
				<input type="submit" name="category" value="'.$category["name"].'" class="category_name">'.
				'</input></form>';
			}
		?>
		</div>
		<div id="product_display">
			<?php
				$products = get_products();
				foreach ($products as $product)
				echo '<div class="product">
					<div class="product_name">'
					.$product["name"].
					'</div>'.
					'<img class="product_img" src="'. $product["image"]. '" />
					<div class="product_info">
						<div class="product_price">
							$'.$product["price"].'
						</div>
						<div>
							<form action="add_to_basket.php" method="post">
								<input type="submit" name="addToBasket" value="'.$product["id"].
								'">
							</form>
						</div>
					</div>
					</div>';
			?>
		</div>
	</div>
</body>
</html>
