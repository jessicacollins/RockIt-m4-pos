<?php

require('initialize.php');

//Select all invoices
$sql = "
SELECT invoice_id, first_name, last_name, SUM(quantity*price) as 'subtotal'
FROM customer
JOIN invoice ON (customer.id = invoice.customer_id)
JOIN invoice_item ON (invoice.id = invoice_item.invoice_id)
JOIN item ON (invoice_item.item_id = item.id)
group by invoice_id;
";

$statement = DB::prepare($sql);
DB::execute($statement);
$results = $statement->fetchAll();

$items = '';
foreach ($results as $row) {
$items .= '<tr><td>' . $row['invoice_id'] . '</td><td>' . $row['first_name']
. ' ' . $row['last_name'] . '</td><td>' . $row['subtotal'] . '</td>
<td>' . '<a href="get_details.php?invoiceId=' . $row['invoice_id'] . '&action=view">Details</a>';
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
	<table>
		<tr>
			<td>#</td>
			<td>Customer Name</td>
			<td>Total</td>
			<td>Details</td>	
		</tr>
		<?php echo $items; ?>
	</table>
</body>
</html>