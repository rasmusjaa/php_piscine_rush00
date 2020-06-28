<?php
	session_start();
	include_once 'products.php';
	include_once 'categories.php';
	include_once 'users.php';
	include_once 'orders.php';
	if ($_SESSION['user_role'] != "0")
		header('Location: index.php?status=forbidden');
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
		<div id="admin_area">
			<div id="admin_status">
				<?php
					if ($_GET['order'] == 'removed')
						echo 'Order removed successfully, or was already non-existent';
					if ($_GET['order'] == 'modified')
						echo 'Order modified successfully, or did not exist';
					if ($_GET['order'] == 'not_modified')
						echo 'Order modification failed, check that order exists';

					if ($_GET['user'] == 'created')
						echo 'New user created successfully';
					if ($_GET['user'] == 'not_created')
						echo 'User creation failed, check that all fields are filled correctly and user does not exist';
					if ($_GET['user'] == 'removed')
						echo 'User removed successfully, or was already non-existent';
					if ($_GET['user'] == 'modified')
						echo 'User modified successfully, or did not exist';
					if ($_GET['user'] == 'not_modified')
						echo 'User modification failed, check that user exists';

					if ($_GET['product'] == 'created')
						echo 'New product created successfully';
					if ($_GET['product'] == 'not_created')
						echo 'Product creation failed, check that all fields are filled correctly and price is more than 0';
					if ($_GET['product'] == 'removed')
						echo 'Product removed successfully, or was already non-existent';
					if ($_GET['product'] == 'modified')
						echo 'Product modified successfully, or did not exist';
					if ($_GET['product'] == 'not_modified')
						echo 'Product modification failed, check that old product exists and all fields are filled correctly';

					if ($_GET['productcategory'] == 'removed')
						echo 'Product removed from category successfully or was not there to begin with';
					if ($_GET['productcategory'] == 'added')
						echo 'Product added to category successfully';
					if ($_GET['productcategory'] == 'not_modified')
						echo 'Could not modify product category, check product and category';
					if ($_GET['category'] == 'created')
						echo 'New category created successfully';
					if ($_GET['category'] == 'not_created')
						echo 'Category creation failed, add proper category name that is not duplicate of existing one';
					if ($_GET['category'] == 'removed')
						echo 'Category removed successfully, or was already non-existent';
					if ($_GET['category'] == 'modified')
						echo 'Category modified successfully, or did not exist';
					if ($_GET['category'] == 'not_modified')
						echo 'Category modification failed, check that old category exists and fields are filled correctly';
				?>
			</div>
			<div id="admin_orders" class="admin_section">
				<h2>Orders</h2>
					<?php
					$orders = get_orders();
					foreach ($orders as $order) {
						echo (
							'<div class="admin_order">
								<div class="order_info">
								<span style="margin: 5px 0px;"> Customer: '.$order['username'].'</span>
								<span style="margin: 5px 0px;"> Order id: '.$order['id'].'</span>
								<span style="margin: 5px 0px;"> Total: $'.$order['total'].'</span>
								<span style="margin: 5px 0px;"> Status: '.$order['status'].'</span>
								</div>'

						);

						foreach ($order['products'] as $product) {
							echo (
								'<div class="admin_product"><span class="admin_product_name" >Product id: '.$product['id'].' </span><span class="admin_product_name" >qty: '.$product['quantity'].' </span><span class="admin_product_name" >Name: '.$product['name'].'</span><b class="admin_product_price">$'.$product['price'].'</b></div>'
							);
						}
						echo '</div><br />';
					}
					?>
				<h3>Modify order</h3>
				<form action="modify_order.php" method="post">
				Order id:
				<br />
				<input type="text" name="id" />
				<br />
				<label for="status">Change status:</label>
				<select id="status" name="status">
					<option value="pending">Pending</option>
					<option value="ready">Ready</option>
					<option value="cancelled">Cancelled</option>
				</select>
				<br>
				<br>
				<input type="checkbox" id="remove" name="remove" value="remove">
				<label for="remove"> Remove order (fill "Order id")</label>
				<br>
				<input type="submit" name="submit" value="OK" />
				</form>
			</div>
			<div id="admin_users" class="admin_section">
				<h2>users</h2>
				<?php
					$users = get_users();
					foreach ($users as $user) {
						if ($user['role'] == '0')
							$role_text = "admin";
						else
							$role_text = "user";
						echo (
							'<div class="admin_product"><span class="admin_product_name" >'.$user['username'].'</span><b class="admin_product_price">role: '. $role_text .'</b></div>'
						);
					}
				?>
				<h3>Add new user</h3>
				<form action="add_user.php" method="post">
				User name:
				<br />
				<input type="text" name="name" />
				<br />
				User password:
				<br />
				<input type="password" name="password" />
				<br />
				<input type="radio" id="1" name="role" value="1" checked="checked">
				<label for="1">User</label>
				<input type="radio" id="0" name="role" value="0">
				<label for="0">Admin</label><br>
				<br>
				<input type="submit" name="submit" value="OK" />
				</form>

				<h3>Modify user</h3>
				<form action="modify_user.php" method="post">
				User name:
				<br />
				<input type="text" name="name" />
				<br />
				<input type="radio" id="1" name="role" value="1" checked="checked">
				<label for="1">User</label>
				<input type="radio" id="0" name="role" value="0">
				<label for="0">Admin</label><br>
				<br>
				<input type="checkbox" id="remove" name="remove" value="remove">
				<label for="remove"> Remove user (fill "User name")</label>
				<br>
				<input type="submit" name="submit" value="OK" />
				</form>
			</div>
			<div id="admin_products" class="admin_section">
				<h2>Products</h2>
				<?php
					$products = get_products(true);
					foreach ($products as $product) {
						echo (
							'<div class="admin_product"><span class="admin_product_name" >Id: '.$product['id'].' </span><span class="admin_product_name" >'.$product['name'].'</span><b class="admin_product_price">$'.$product['price'].'</b></div>'
						);
					}
				?>
				<h3>Add new product</h3>
				<form action="add_product.php" method="post">
				Product name:
				<br />
				<input type="text" name="name" />
				<br />
				Product price (must be in int or float format, e.g. 9.95):
				<br />
				<input type="text" name="price" />
				<br />
				Product image (with path e.g. ./images/example.jpg):
				<br />
				<input type="text" name="image" />
				<br />
				<input type="submit" name="submit" value="OK" />
				</form>

				<h3>Modify product</h3>
				<form action="modify_product.php" method="post">
				Old product name:
				<br />
				<input type="text" name="name" />
				<br />
				New product name:
				<br />
				<input type="text" name="newname" />
				<br />
				New product price:
				<br />
				<input type="text" name="price" />
				<br />
				New product image:
				<br />
				<input type="text" name="imag" />
				<br />
				<input type="checkbox" id="remove" name="remove" value="remove">
				<label for="remove"> Remove product (fill old "Old product name")</label>
				<br>
				<input type="submit" name="submit" value="OK" />
				</form>
			</div>
			<div id="admin_categories" class="admin_section">
				<h2>Categories</h2>
				<?php
					$categories = get_categories();
					foreach ($categories as $category) {
						echo (
							'<div class="admin_product"><span class="admin_product_name" >Id: '.$category['id'].' </span><span class="admin_product_name" >'.$category['name'].'</span><b class="admin_product_price"></b></div>'
						);
					}
				?>
				<h3>Modify product category</h3>
				<form action="modify_product_category.php" method="post">
				Product id:
				<br />
				<input type="text" name="product_id" />
				<br />
				Category id:
				<br />
				<input type="text" name="category_id" />
				<br />
				<input type="radio" id="add" name="mod" value="add" checked="checked">
				<label for="add">Add to category</label>
				<input type="radio" id="remove" name="mod" value="remove">
				<label for="remove">Remove from category</label>
				<br>
				<input type="submit" name="submit" value="OK" />
				</form>

				<h3>Add new category</h3>
				<form action="add_category.php" method="post">
				Category name:
				<br />
				<input type="text" name="name" />
				<br />
				<input type="submit" name="submit" value="OK" />
				</form>

				<h3>Modify category</h3>
				<form action="modify_category.php" method="post">
				Old category name:
				<br />
				<input type="text" name="name" />
				<br />
				New category name:
				<br />
				<input type="text" name="newname" />
				<br />
				<input type="checkbox" id="remove" name="remove" value="remove">
				<label for="remove"> Remove category (fill old "Old category name")</label>
				<br>
				<input type="submit" name="submit" value="OK" />
				</form>
			</div>
		</div>
	</div>
</body>
</html>
