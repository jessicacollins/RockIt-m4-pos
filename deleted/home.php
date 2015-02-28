<?php  


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<style>
		body {
			background-color: lightgrey;
		}
	</style>

</head>
<body>
<h1>My Shop</h1>
	if (!empty($_GET['invoicesRemoved'])) {
		echo '<div>Invoices Removed:[' . $_GET['invoicesRemoved'] . ']</div>';
	}
<a href="get_users.php">Customers</a>
	
</body>
</html>