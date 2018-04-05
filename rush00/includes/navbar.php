<div class = "barre">
	<a href="./panier.php" style="text-decoration:none;">
		<img class = "panier" src = "img/panier.png">
		<div class = "total"> Total des achats : <br/> <?php echo number_format(get_cart()['total_price'], 2); ?>€
	</a>

	<?php require_once "./includes/user_form.php"; ?></div>
</div>
