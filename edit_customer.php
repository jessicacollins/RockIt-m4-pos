<?php

// Initialize Code
require('initialize.php');

$customerId = getIsset('customerId');

$sql = "
	SELECT *
	FROM customer
	WHERE id = :customerId
	";

$statement = DB::prepare($sql);
$statement->bindValue(':customerId', $customerId, PDO::PARAM_INT);
$statement->execute();
$results = $statement->fetchAll();

$male = '';
$female ='';
$inputs = '';

foreach ($results as $row) {
	$gender = $row['gender'];

	if ($gender == 'male') {
		$male = 'selected';
	}else {
		$female = 'selected';
	} 

	$inputs .= '<input type="hidden" name="customerId" value="'.$customerId.'">';
	$inputs .= '<div>First Name <input type="text" name="firstName" value="'.$row['first_name'].'"></div>';
	$inputs .= '<div>Last Name <input type="text" name="lastName" value="'.$row['last_name'].'"></div>';
	$inputs .= '<div>Email <input type="text" name="email" value="'. $row['email'] . '"></div>';
	$inputs .= '<div><select name="gender">';
	$inputs .= '<option value="male"'.$male.'>Male</option>';
	$inputs .= '<option value="female"'.$female.'>Female</option>';
	$inputs .= '</select></div>';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Edit Customer</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<a href="main.php">Home</a>
	<h1>Edit Customer</h1>
	<form action="process_edit_customer.php" method="POST">
	<?php echo $inputs ?>
	<div><button>Update</button></div>
	</form>
</body>
</html>

