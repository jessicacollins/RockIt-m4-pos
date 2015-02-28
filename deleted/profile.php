<?php

// Initialize Code
require('initialize.php');


$sql = "
	SELECT *
	FROM customer
	WHERE id = :id
	";

// Make a PDO statement
$statement = DB::prepare($sql);

$prepare_values = [
	':id' => $_GET['id']
];

// Execute
DB::execute($statement, $prepare_values);

// Get all the results of the statement into an array
$results = $statement->fetchAll();

// Get the first result as a row
$row = $results[0];
$first_name = $row['first_name'];

?>


<h1>This is the profile for: <?php echo $first_name; ?></h1>
