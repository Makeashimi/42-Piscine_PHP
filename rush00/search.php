<?php
	session_start();

	require_once "./dbh.php";

	if (!isset($_POST['search'])) {
		header("Location: ./");
		die();
	}

	$products = search_product($_POST['search']);
	echo "Found " . count($products) . " result matching your search: <br/><br/>";
	foreach ($products as $product) {
		echo "<a href='./product.php?id=" . $product['id'] . "'>" . $product['name'] ."</a><br />";
	}
?>

<form method="post" action="search.php">
	<input type="text" name="search" placeholder="search ..." /><input type="submit" />
</form>
