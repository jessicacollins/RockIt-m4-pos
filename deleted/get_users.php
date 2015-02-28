<?php

// Initialize Code
require('initialize.php');


$sql = "SELECT * FROM customer";

// Make a PDO statement
$statement = DB::prepare($sql);

// Execute
$statement->execute();

// Get all the results of the statement into an array
$results = $statement->fetchAll();

// Loop array to get each row
$lis = '';
foreach ($results as $row) {
	$lis .= '<li><a href="profile.php?id=' . $row['id'] . '">' . $row['first_name'] . '</a>
	<a href="edit_customer.php?id=' . $row['id'] . '">Edit</a></li>'; 
}

?>


<ul>
	<?php echo $lis; ?>
</ul>