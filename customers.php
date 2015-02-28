<?php

// Initialize Code
require('initialize.php');

//Select all customers
$sql = "SELECT * FROM customer";

$statement = DB::prepare($sql);
DB::execute($statement);
$results = $statement->fetchAll();

$items = '';
foreach ($results as $row) {

	$items .= '<tr><td>' . $row['first_name'] . ' ' . $row['last_name'] . '</td>
	<td><a href="/add_invoice.php?customerId=' . $row['id'] . '">New Invoice</a></td>
	<td><a href="/edit_customer.php?customerId=' . $row['id'] . '">Edit</a></td>
	<td><a href="/remove_customer.php?customerId=' . $row['id'] . '">Remove</a></td></tr>';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Customers</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<a href="main.php">Home</a>
	<h1>Customers</h1>
	<?php
	if (isset($_GET['rowsUpdated'])) {
		echo '<div>Number of Customers updated:[' . $_GET['rowsUpdated'] .']</div>';
	}
	if (isset($_GET['invoiceRemoved'])) {
		echo '<div>Number of invoices removed:[' . $_GET['invoiceRemoved'] . ']</div>';
	}
	if (isset($_GET['customerRemoved'])) {
	echo '<div>Number of customers removed:[' . $_GET['customerRemoved'] . ']</div>';
	}
	if (isset($_GET['customerAdded'])) {
	echo '<div>Number of customers added:[' . $_GET['customerAdded'] . ']</div>';
	}
	?>
	<table>
		<?php echo $items; ?>
	</table>
	<form action="/addCustomer.php" method="POST">
		<input type="hidden" name="action" value="add">

		<label for="firstName">First Name: </label>
		<input type="text" id="firstName" name="firstName">		

		<label for="lastName">Last Name: </label>
		<input type="text" id="lastName" name="lastName">

		<label for="email">Email: </label>
		<input type="email" id="email" name="email">

		<label for="gender">Gender: </label>
		<select name="gender" id="gender">
			<option value="">Choose</option>
			<option value="male">Male</option>
			<option value="female">Female</option>
		</select>
		<button type="submit">Add Customer</button>
	</form>
</body>
</html>

