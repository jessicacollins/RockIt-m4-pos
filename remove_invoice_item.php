<?php 

require('initialize.php');

$invoice_item_sql = 
	"DELETE FROM invoice_item WHERE id = :invoiceItemId";

$invoice_item_count =
	"SELECT count(*) as count FROM invoice_item WHERE invoice_id = :invoiceId";

$deleteInvoiceSql = 
	"DELETE FROM invoice WHERE id = :invoiceId";

$invoiceItemId = $_GET['invoiceItemId'];
$invoiceId = $_GET['invoiceId'];

$statement = DB::prepare($invoice_item_sql);
$statement->bindValue(':invoiceItemId', $invoiceItemId, PDO::PARAM_INT);
$statement->execute();
$invoiceItemsRemoved = $statement->rowCount();

$statement = DB::prepare($invoice_item_count);
$statement->bindValue(':invoiceId', $invoiceId, PDO::PARAM_INT);
$statement->execute();
$results = $statement->fetchAll();

$invoicesRemoved = NULL;

foreach ($results as $row) {
	if ($row['count'] == 0) {
		//delete invoice
		$statement = DB::prepare($deleteInvoiceSql);
		$statement->bindValue(':invoiceId', $invoiceId, PDO::PARAM_INT);
		$statement->execute();
		$invoicesRemoved = $statement->rowCount();

		header('Location: /main.php?invoicesRemoved=' . $invoicesRemoved);
		exit();
	}
}

// Redirect
header('Location: /get_details.php?invoiceItemsRemoved=' . $invoiceItemsRemoved . '&action=delete&invoiceId=' 
	. $invoiceId);
exit();


?>