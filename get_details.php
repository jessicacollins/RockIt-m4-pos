<?php
// Initialize Code
require('initialize.php');

$invoiceId = getIsset('invoiceId');

if(empty($invoiceId)) {
	header('Location: /invoices.php');
	exit();
}

//Get details for specified invoice
$sql = "
SELECT ii.quantity, it.name, it.price, ii.id, (ii.quantity*it.price) as 'subtotal'
FROM invoice i, invoice_item ii, item it
WHERE i.id = :invoiceId
AND ii.invoice_id = i.id
AND it.id = ii.item_id
";

$statement = DB::prepare($sql);
$statement->bindValue(':invoiceId', $invoiceId, PDO::PARAM_INT);
$statement->execute();
$results = $statement->fetchAll();

$items = '';
$total = '';
foreach ($results as $row) {
	$items .= '<tr><td>' . $row['quantity'] . '</td><td>' . $row['name'] . '</td><td>' . $row['price'] . '</td><td>' . $row['subtotal'] . '</td>
	<td>' . '<a href="remove_invoice_item.php?invoiceItemId=' . $row['id'] . '&invoiceId=' . $invoiceId . '">Remove</a></td></tr>';
	$total += $row['subtotal'];
}

//Get all items for the add item select list
$selectItemsSql = "SELECT id, name FROM item";
$statement = DB::prepare($selectItemsSql);
DB::execute($statement);
$results = $statement->fetchAll();

$value = '';
foreach ($results as $row) {
$value .= '<option value="' . $row['id'] . '">' . $row['name'] .  '</option>';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Invoices</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<a href="main.php">Home</a>
	<h1>Invoices</h1>
	<?php 

	if (!empty($_GET['invoiceItemsRemoved'])) {
		echo '<div>Invoice Items Removed:[' . $_GET['invoiceItemsRemoved'] . ']</div>';
	}

	?>
	<table>
		<tr>
			<td>Quantity</td>
			<td>Item</td>
			<td>Cost</td>
			<td>Sub Total</td>	
			<td>Remove</td>	
		</tr>
		<?php echo $items; ?>
		<tr>
			<td></td>
			<td></td>
			<td>Total</td>
			<td><?php echo $total; ?></td>
			<td></td>
		</tr>
	</table>
	<form action="/add_invoice_item.php" method="POST">
		<input type="hidden" value="<?php echo $invoiceId; ?>" name="invoiceId">
		<input type="hidden" value="add" name="action">
		<table class="addItem">
			<tr>
				<td>Qty</td>
				<td>Item</td>
			</tr>
			<tr>
				<td>
					<input type="text" name="qty">
				</td>
				<td>
					<select name="itemId">
						<option value="" selected>Choose</option>
						<?php echo $value; ?>
					</select>
				</td>
				<td><button type="submit" class="add">Add</button></td>
			</tr>
		</table>
	</form>
</body>
</html>