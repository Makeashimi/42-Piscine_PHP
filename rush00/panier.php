<?php
	session_start();

	require_once "./dbh.php";

	if (isset($_POST['update'])) {
		if ((is_int($_POST['qte']) || ctype_digit($_POST['qte']))) {
			if ((int)$_POST['qte'] === 0)
				remove_cart_qte($_POST['id']);
			else
				update_cart_qte($_POST['id'], $_POST['qte']);
		}
	} else if (isset($_POST['delete'])) {
		remove_cart_qte($_POST['id']);
	} else if (isset($_POST['buy'])) {
		create_order();
	}

	$cart = get_cart();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Gaming Shop</title>
		<link rel = "stylesheet" href = "./css/presentation.css">
		<link rel = "stylesheet" href = "./css/panier.css">
		<meta charset = "utf-8">
	</head>
	<body>
		<?php require_once("./includes/navbar.php"); ?>
		<br/>
		<div class = "central">
			<center>
				<h1><a style="color:white !important; text-decoration:none;" href="./">← Retour</a></h1>
			</center>

			<?php
				if (count($cart['products']) === 0)
					echo '<center style="color:white;"><h1>Votre panier est vide.</h1></center>';
				else { ?>
			<table>
				<tr>
					<th class = "titre"> Image du jeu </th>
					<th class = "titre"> Nom du jeu </th>
					<th class = "titre"> Prix </th>
					<th class = "titre"> Quantité </th>
				</tr>

				<?php foreach ($cart['products'] as $cart_item) {
					?>
						<form method="post">
							<?php $product = get_product_by_id($cart_item['id']); ?>
						<tr>
							<td> <img src = "<?php echo $product['img_url']; ?>"> </td>
							<td> <?php echo $product['name']; ?> </td>
							<td> <?php echo $product['price']; ?>€ x <?php echo $cart_item['qte']; ?> = <?php echo $product['price'] * $cart_item['qte']; ?>€ </td>
							<td> <?php echo $cart_item['qte']; ?>x <br/>
							<input type="hidden" value="<?php echo $cart_item['id']; ?>" name="id" />
							<input type = "number" name="qte" placeholder = "Modifier la quantité" />
							<br/>
							<input type = "submit" name="update" value = "Mettre à jour" />
							<input type = "submit" name="delete" value = "Supprimer ce jeu">
							</td>
						</tr>
						</form>
				<?php }	?>




				<tr>
					<th class = "prix" colspan = "4"> Total : <?php echo number_format($cart['total_price'], 2); ?>€

					<?php
					if (is_signed_in()) {
						if (count($cart['products']) !== 0) {
							?>
							<form method="post" style="display:inline;">
								<input type="submit" name="buy" value = "JOUUEEEERRR !"/>
							</form>
					<?php
						}
					}
					else { ?>
						<strong> - Merci de bien vouloir vous connecter pour finaliser votre commande.</strong>
					<?php } ?>

					</th>
				</tr>
			</table>

		<?php } ?>


			<br/><br/>



		</div>
	</body>
</html>