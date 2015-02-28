<?php  

class ItemModel {
	// public static function create($name, $price) {

	// 		$addItemSql = "INSERT INTO item (name, price) 
	// 		VALUES (:name, :price)";

	// 		$statement = DB::prepare($addItemSql);
	// 		$statement->bindValue(':name', $name, PDO::PARAM_STR);
	// 		$statement->bindValue(':price', $price, PDO::PARAM_INT);
	// 		$statement->execute();

	// 		$itemsAdded = $statement->rowCount();
	// 		// Redirect
	// 		// return header('Location: /items.php?itemsAdded='. $itemsAdded);
	// 		// exit();
	// 		$adds = '';
	// 		return $adds;
	// 	}

	// public static function update($itemId) {

	// 	$sql = "SELECT * FROM item WHERE id = :itemId";

	// 	$statement = DB::prepare($sql);
	// 	$statement->bindValue(':itemId', $itemId, PDO::PARAM_INT);
	// 	$statement->execute();
	// 	$results = $statement->fetchAll();

	// 	$inputs = '';
	// 	foreach ($results as $row) {
	// 		$inputs .= '<input type="hidden" name="itemId" value="' . $row['id'] . '">';
	// 		$inputs .= '<div>Name <input type="text" name="name" value="' . $row['name'] . '"></div>';
	// 		$inputs .= '<div>Price <input type="text" name="price" value="' . $row['price'] . '"></div>';
	// 	}

	// 	return $inputs;
	// } 

	// public static function delete($id) {

	// }
	public static function getItems() {
		$sql = "SELECT * FROM item";

		$statement = DB::prepare($sql);
		$statement->execute();
		$results = $statement->fetchAll();

		$items = '';
		foreach ($results as $row) {
			$itemId = $row['id'];

			$items .= '<tr>';
			$items .= '	<td>' . $row['name'] . '</td>';
			$items .= '	<td>' . $row['price']. '</td>';
			$items .= '	<td><a href="/edit_item.php?itemId=' . $itemId . '">Edit</a></td>';
			$items .= '	<td><a href="/remove_item.php?itemId=' . $itemId . '">Remove</a></td>';
			$items .= '</tr>';
		}
		return $items;
	}
}
