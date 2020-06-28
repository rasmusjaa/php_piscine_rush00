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
<?php
    include_once 'products.php';
    session_start();
    ?>
<div class="basket">
    <h2>Shopping basket</h2>
<?php if ($_SESSION['basket']) {

	$total = 0;
	$products = array_count_values($_SESSION['basket']);
    foreach($products as $item => $quantity) {
        $product = get_product($item);
        $total += $product[3];
        echo ('<div class="cart_product">
        <form method="post" action="remove_from_basket.php">
        <input type="submit" name="remove_product" class="remove_product_btn" value="'.$product[1].'" /><br/>
		</form>
		<div class="cart_product_info">
		<span>'.$product[0].' </span><b class="cart_price">$'.$product[3]."</b>
		<span>amount: $quantity</span>
		</div>
		</div>"
    );
    }
}
?>
<div id="basket_info">
	<?php
		if ($_SESSION['basket'] != null)
			echo "Total: $".$total;
		else if ($_GET[order] != "success")
			echo "Basket is empty";
    ?>
</div>
<div id="validate">
	<?php
		if ($_SESSION['logged_on_user'] && $_SESSION['logged_on_user'] != '')
		{
			if ($_GET[order] === "success")
			{
				echo '<p style="margin"10px 0px">Order validated succesfully!</p>
				';
			}
			else if ($_SESSION['basket'] != null)
			{
				echo '<a class="button1" style="margin-right: 5px" href="validate.php">Validate order</a>
				';
			}
		}
		else if ($_SESSION['basket'] != null)
		{
			echo '<p style="margin"10px 0px">You must be logged in to validate order!</p>
			';
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
</body>
</html>

