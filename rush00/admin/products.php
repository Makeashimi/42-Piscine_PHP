<?php
	session_start();
	require_once "../dbh.php";

	require_admin();

	if (isset($_POST['delete'])) {
		delete_product($_POST['id']);
		echo "<strong></stronh>Product was successfully deleted!</strong><br /><br />";
	} else if (isset($_POST['edit'])) {
		$categories = array();
		if (isset($_POST['categories']))
			$categories = $_POST['categories'];
		update_product($_POST['id'], $_POST['name'], $_POST['description'], $_POST['img_url'], $categories, $_POST['price']);
		echo "<strong></stronh>Product was successfully updated!</strong><br /><br />";
	} else if (isset($_POST['create'])) {
		$categories = array();
		if (isset($_POST['categories']))
			$categories = $_POST['categories'];
		create_product($_POST['name'], $_POST['description'], $_POST['img_url'], $categories, $_POST['price']);
		echo "<strong></stronh>Product was successfully created!</strong><br /><br />";
	}

	$products = get_products();
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Admin - Produits</title>
</head>
<body>
	<h3><a href="./">← Retour</a></h3>

	<h3>Créer un nouveau produit</h3>

	<form method="post" style="border:1px solid black; padding:10px;">
		<input type="text" name="name" placeholder="Nom"/>
		<input type="text" name="description" placeholder="Description"/>
		<input type="text" name="img_url" placeholder="URL de l'image"/>
		<input type="text" name="price" placeholder="Prix"/>

		<br /><br />

		Catégories:
		<?php
			$categories = get_categories();
			foreach ($categories as $pc) {
				echo ' <input type="checkbox" name="categories[]" value="' . $pc['id'] . '" /> ' . $pc['name'];
			}
		?>

		<br /><br />
		<input type="submit" name="create" value="Créer"/>
	</form>


	<h3>Gestion des produits</h3>

	<?php

	foreach ($products as $product) {
		?>
			<form method="post" style="border: 1px solid black; padding:10px;">
				<input type="hidden" name="id" value="<?php echo $product['id']; ?>" />
				<input type="text" name="name" value="<?php echo $product['name']; ?>"/>
				<input type="text" name="description" value="<?php echo $product['description']; ?>"/>
				<input type="text" name="img_url" value="<?php echo $product['img_url']; ?>"/>
				<input type="text" name="price" value="<?php echo $product['price']; ?>"/>

				<br /><br />
				Catégories:
				<?php
					$productCategories = get_product_categories($product['id']);

					foreach ($productCategories as $pc) {
						if ($pc['active'] === '1')
							echo ' <input type="checkbox" name="categories[]" value="' . $pc['id'] . '" checked/> ' . $pc['name'];
						else
							echo ' <input type="checkbox" name="categories[]" value="' . $pc['id'] . '" /> ' . $pc['name'];
					}
				?>

				<br /><br />
				<input type="submit" name="edit" value="Modifier"/>
				<input type="submit" name="delete" value="Supprimer"/>
			</form>
		<?php
	}

	?>
</body>
</html>
