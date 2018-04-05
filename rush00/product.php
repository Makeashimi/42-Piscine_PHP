<?php
	session_start();

	require_once "./dbh.php";
	if (!isset($_GET['id'])) {
		header("Location: ./");
		die();
	}

	$product = get_product_by_id($_GET['id']);
	if ($product === NULL) {
		header("Location: ./");
		die();
	}

	if (isset($_POST['addtocart'])) {
		$qte = $_POST['quantity'];
		if ((is_int($qte) || ctype_digit($qte)) && (int)$qte > 0 ) {
			add_to_cart($_POST['game_id'], (int)$qte, $_POST['price']);
		}
	}
?>

<h1><?php echo $product['name']; ?></h1>
<img height=200 src="<?php echo $product['img_url']; ?>"/>
<p>
	<?php echo $product['description']; ?>
</p>

PRIX: <?php echo $product['price']; ?>Euro <br /><br />

<form method="post">
	<input type="hidden" name="price" value="<?php echo $product['price']; ?>" />
	<input type="text" name="quantity" value=1 />
	<input type="submit" name="addtocart" value="Ajouter au panier"/>
</form>
