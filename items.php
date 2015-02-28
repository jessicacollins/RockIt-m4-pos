<?php

require('initialize.php');

$items = ItemModel::getItems();

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Items</title>
		<link rel="stylesheet" href="style.css">
	</head>
	<body>
		<a href="main.php">Home</a>
		<h1>Items</h1>
		
		<?php 
			if ( isset($_GET['invoiceItemsRemoved']) && $_GET['invoiceItemsRemoved'] > 0) {
				echo '<div>Total invoice items removed:[' . $_GET['invoiceItemsRemoved'] . ']</div>';
			}

			if ( isset($_GET['itemsRemoved']) ) {
				echo '<div>Total items removed:[' . $_GET['itemsRemoved'] . ']</div>';
			}

			if ( isset($_GET['itemsUpdated']) ) {
				echo '<div>Total items updated:[' . $_GET['itemsUpdated'] . ']</div>';
			}
		?>

		<table>
			<tr>
				<td>Item Name</td>
				<td>Price</td>
				<td>Edit Item</td>	
				<td>Remove Item</td>	
			</tr>
			<?php echo $items; ?>
		</table>
		<form action="/process_item.php" method="POST">
			<input type="hidden" name="action" value="add">
			<label for="name">Name: </label><input id="name" type="text" name="name">
			<label for="price">Cost: </label><input id="price" type="text" name="price">
		<button>Add item</button>
	</form>
	</body>
</html>