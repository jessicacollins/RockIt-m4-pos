<?php

// Initialize Code
require('initialize.php');

	$itemId = getIsset('itemId');

	if(empty($itemId)) {
		header('Location: /items.php');
		exit();
	}

		$sql = "SELECT * FROM item WHERE id = :itemId";

		$statement = DB::prepare($sql);
		$statement->bindValue(':itemId', $itemId, PDO::PARAM_INT);
		$statement->execute();
		$results = $statement->fetchAll();

		$inputs = '';
		foreach ($results as $row) {
			$inputs .= '<input type="hidden" name="itemId" value="' . $row['id'] . '">';
			$inputs .= '<div>Name <input type="text" name="name" value="' . $row['name'] . '"></div>';
			$inputs .= '<div>Price <input type="text" name="price" value="' . $row['price'] . '"></div>';
		}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Edit Item</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<a href="main.php">Home</a>
	<h1>Edit Item</h1>
	<form action="process_item.php" method="POST">
	<?php echo $inputs ?>
	<button>Update</button>
	</form>
</body>
</html>