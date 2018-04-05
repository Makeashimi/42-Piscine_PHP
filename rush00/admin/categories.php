<?php
	session_start();
	require_once "../dbh.php";

	require_admin();

	if (isset($_POST['create'])) {
		create_category($_POST['name']);
		echo "<strong>Category was successfully created.</strong><br /><br />";
	} else if (isset($_POST['delete'])) {
		delete_category($_POST['id']);
		echo "<strong>Category was successfully deleted.</strong><br /><br />";
	}

	$categories = get_categories();
?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Admin - Catégories</title>
</head>
<body>
	<h3><a href="./">← Retour</a></h3>
	<h3>Créer une nouvelle catégorie</h3>

	<form method="post" style="border:1px solid black; padding:10px;">
		<input type="text" name="name" placeholder="category name" />
		<input type="submit" name="create" value="create" />
	</form>


	<h3>Gestion des catégories</h3>
	<?php

		foreach ($categories as $category) {
			?>

			<form method="post" style="border:1px solid black; padding:10px;">
				<input type="hidden" name="id" value="<?php echo $category['id']; ?>" >
				<input type="text" name="name" value="<?php echo $category['name']; ?>" />
				<input type="submit" name="edit" value="Modifier" />
				<input type="submit" name="delete" value="Supprimer" />
				<a href="../category.php?id=<?php echo $category['id']; ?>">Voir sur le magasin</a>
			</form>

			<?php
		}

	 ?>
</body>
</html>
