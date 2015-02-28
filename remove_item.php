<?php  

require('initialize.php');

$itemId = getIsset('itemId');
if (empty($itemId)) {
	header('Location: /items.php');
	exit();
}

$item_sql = "DELETE FROM item WHERE id = :itemId";

$invoice_item_sql = "DELETE FROM invoice_item WHERE item_id = :itemId";

$statement = DB::prepare($invoice_item_sql);
$statement->bindValue(':itemId', $itemId, PDO::PARAM_INT);
$statement->execute();
$invoiceItemsRemoved = $statement->rowCount();

$statement = DB::prepare($item_sql);
$statement->bindValue(':itemId', $itemId, PDO::PARAM_INT);
$statement->execute();
$itemsRemoved = $statement->rowCount();

// Redirect
header('Location: /items.php?itemsRemoved=' . $itemsRemoved.'&invoiceItemsRemoved='.$invoiceItemsRemoved);
exit();

?>