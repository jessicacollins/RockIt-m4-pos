<?php  

require('initialize.php');

	$firstName  = postIsset('firstName');
	$lastName  = postIsset('lastName');
	$email  = postIsset('email');
	$gender  = postIsset('gender');

	if(empty($firstName)) {
		header('Location: /customers.php');
		exit();
	} elseif (empty($lastName)) {
		header('Location: /customers.php');
		exit();		
	} elseif (empty($email)) {
		header('Location: /customers.php');
		exit();		
	} elseif (empty($gender)) {
		header('Location: /customers.php');
		exit();		
	}

	$addItemSql = "INSERT INTO customer (first_name, last_name, email, gender) 
	VALUES (:firstName, :lastName, :email, :gender)";

	$statement = DB::prepare($addItemSql);
	$statement->bindValue(':firstName', $firstName, PDO::PARAM_STR);
	$statement->bindValue(':lastName', $lastName, PDO::PARAM_STR);
	$statement->bindValue(':email', $email, PDO::PARAM_STR);
	$statement->bindValue(':gender', $gender, PDO::PARAM_STR);
	$statement->execute();

	$customerAdded = $statement->rowCount();
	// Redirect
	header('Location: /customers.php?customerAdded='. $customerAdded);
	exit();


?>