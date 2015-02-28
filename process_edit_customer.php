<?php

// Initialize Code
require('initialize.php');

$customerId = postIsset('customerId');
if(empty($customerId)) {
	header('Location: /customers.php');
	exit();
}
$firstName = postIsset('firstName');
if(empty($firstName)) {
	header('Location: /customers.php');
	exit();
}
$lastName = postIsset('lastName');
if(empty($lastName)) {
	header('Location: /customers.php');
	exit();
}
$email = postIsset('email');
if(empty($email)) {
	header('Location: /customers.php');
	exit();
}
$gender = postIsset('gender');
if(empty($gender)) {
	header('Location: /customers.php');
	exit();
}

$sql = 
	"UPDATE pos.customer 
		SET first_name = :firstName, last_name = :lastName, email = :email, gender = :gender WHERE id = :customerId";

$statement = DB::prepare($sql);

$statement->bindValue(':firstName', $firstName,PDO::PARAM_STR);
$statement->bindValue(':lastName', $lastName,PDO::PARAM_STR);
$statement->bindValue(':email', $email,PDO::PARAM_STR);
$statement->bindValue(':gender', $gender,PDO::PARAM_STR);
$statement->bindValue(':customerId', $customerId, PDO::PARAM_INT);

$statement->execute();

$rowsUpdated = $statement->rowCount();

// Redirect
header('Location: /customers.php?rowsUpdated=' . $rowsUpdated);
exit();

?>