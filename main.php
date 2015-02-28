<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Home</title>
	<link rel="stylesheet" href="style.css">

</head>
<body>
<h1>My Shop</h1>
<?php 
	if (!empty($_GET['invoicesRemoved'])) {
		echo '<div>Invoices Removed:[' . $_GET['invoicesRemoved'] . ']</div>';
	}
?>

<a href="customers.php">Customers</a>
<a href="items.php">Items</a>
<a href="invoices.php">Invoices</a>
	
</body>
</html>