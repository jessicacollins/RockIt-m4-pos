<?php  

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

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Add Item</title>
</head>
<body>
	<h1>Add Item</h1>
	<form action="/">
		<div><label>Item Name</label><input type="text" name="name"></div>
		<div><label>Item Price</label><input type="text" name="price"></div>
		<button>Add item</button>
	</form>
</body>
</html>