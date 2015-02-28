<?php

// Initialize Code
require('initialize.php');

//Add item
$action = postIsset('action');
if(empty($action)) {
	header('Location: /items.php');
}

if ($action == 'add') {
	$name = postIsset('name');
	$price = postIsset('price');

	if(!name) {
		header('Location: /items.php');
		exit();
	}
	if(!price) {
		header('Location: /items.php');
		exit();
	}

	$addItemSql = "INSERT INTO item (name, price) 
	VALUES (:name, :price)";

	$statement = DB::prepare($addItemSql);
	$statement->bindValue(':name', $name, PDO::PARAM_STR);
	$statement->bindValue(':price', $price, PDO::PARAM_INT);
	$statement->execute();

	$itemsAdded = $statement->rowCount();
	// Redirect
	header('Location: /items.php?itemsAdded='. $itemsAdded);
	exit();

} else {
	header('Location: /items.php');
	exit();
}
	//Update Item
	$sql = "UPDATE item SET name = :name, price = :price WHERE id = :itemId";

	$itemId = postIsset('itemId');
	$name = postIsset('name');
	$price = postIsset('price');

	if(empty($itemId))  {
		header('Location: /items.php');
		exit();
	}
	if(empty($name)) {
		header('Location: /items.php');
		exit();
	}

	// Make a PDO statement
	$statement = DB::prepare($sql);

	// Bind Parameters individually instead of using sql_values array
	$statement->bindValue(':name', $name,PDO::PARAM_STR);
	$statement->bindValue(':price', $price,PDO::PARAM_INT);
	$statement->bindValue(':itemId', $itemId, PDO::PARAM_INT);

	// Execute
	$statement-> execute();

	$itemsUpdated = $statement->rowCount();

	// Redirect
	header('Location: /items.php?itemsUpdated=' . $itemsUpdated);
	exit();

?>