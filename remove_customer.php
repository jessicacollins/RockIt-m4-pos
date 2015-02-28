<?php  

require('initialize.php');

$customerId = getIsset('customerId');
if(empty($customerId)) {
	header('Location: /customers.php');
	exit();
}

$deleteInvoiceSql = "DELETE FROM invoice WHERE customer_id = :customerId";

$deleteCustomerSql = "DELETE FROM customer WHERE id = :customerId";

$statement = DB::prepare($deleteInvoiceSql);
$statement->bindValue(':customerId', $customerId, PDO::PARAM_INT);
$statement->execute();
$invoiceRemoved = $statement->rowCount();

$statement = DB::prepare($deleteCustomerSql);
$statement->bindValue(':customerId', $customerId, PDO::PARAM_INT);
$statement->execute();
$customerRemoved = $statement->rowCount();

// Redirect
header('Location: /customers.php?invoiceRemoved=' . $invoiceRemoved . '&customerRemoved=' . $customerRemoved);
exit();

?>