<?php  

	require('initialize.php');

	$invoiceId = postIsset('invoiceId');
	$qty = postIsset('qty', 1);
	$itemId = postIsset('itemId');

	if(! $invoiceId) {
		// redirect to Invoice page
		header('Location: /invoices.php');
		exit();
	}

	if(! $itemId) {
		// redirect to Invoice details page
		header('Location: /get_details.php?invoiceId='. $invoiceId);
		exit();
	}

	$addInvoiceItemSql = 
		"INSERT INTO invoice_item (quantity, item_id, invoice_id) 
		VALUES (:qty, :itemId, :invoiceId)";

	$statement = DB::prepare($addInvoiceItemSql);

	$statement->bindValue(':qty', $qty ,PDO::PARAM_INT);
	$statement->bindValue(':itemId', $itemId, PDO::PARAM_INT);
	$statement->bindValue(':invoiceId', $invoiceId, PDO::PARAM_INT);

	echo 'Quantity:[' . $qty . ']';
	$statement->execute();

	header('Location: /get_details.php?invoiceId='. $invoiceId);
	exit();


?>