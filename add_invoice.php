<?php  

	require('initialize.php');

	$customerId = getIsset('customerId');

	if(!customerId) {
		header('Location: /customers.php');
		exit();		
	}

		$createCustomerSql = "
		INSERT INTO invoice (customer_id, created_at) VALUES (:customerId, NOW())";

		$statement = DB::Prepare($createCustomerSql);
		$statement->bindValue(':customerId', $customerId, PDO::PARAM_INT);
		$statement->execute();
		$invoiceId = DB::lastInsertId();

	header('Location: /get_details.php?invoiceId='. $invoiceId);
	exit();
	

?>