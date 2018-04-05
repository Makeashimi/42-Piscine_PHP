<?php
	session_start();
	require_once "./dbh.php";

	$products = get_shuffled_products();
	if (isset($_POST['addtocart'])) {
		$qte = $_POST['quantity'];
		if ((is_int($qte) || ctype_digit($qte)) && (int)$qte > 0 ) {
			add_to_cart($_POST['game_id'], (int)$qte, $_POST['price']);
		}
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Gaming Shop</title>
		<link rel = "stylesheet" href = "./css/presentation.css">
		<meta charset = "utf-8">
	</head>
	<body>
		<?php require_once("./includes/navbar.php"); ?>
		<br/>
		<div class = "central">
			<img class = "concept" src = "img/gaming-concept.jpg">
			<?php require_once("./includes/categories.php"); ?>

			<div class="jeux">
				<br/>

				<?php
				if (count($products) === 0)
					echo "<div class = 'container' style='width:100%; display: inline-block;'><h1 class='noprod'>Il n'y a aucun produit dans cette catégorie.</h1></div>";
				foreach ($products as $product) { ?>
					<form method="post" style="display: inline;">
						<div class = "container" style="display: inline-block;">
							<img class = "pubg" src = "<?php echo $product['img_url']; ?>">
							<div class = "overlay">
								<div class = "text">
									<?php echo $product['description']; ?>
								</div>

								<span class="price">Prix: <?php echo $product['price']; ?>€</span>
								<input type="hidden" name="price" value="<?php echo $product['price']; ?>" />
								<input type="hidden" name="game_id" value="<?php echo $product['id']; ?>" />
								<input class = "quantite" type = "number" name="quantity" value="1" placeholder = "Quantité">
								<input class = "ajouter" name="addtocart" type = "submit" value = "Ajouter">
							</div>
						</div>
					</form>
				<?php } ?>
			</div>

		</div>

		<script> </script>
	</body>
</html>
