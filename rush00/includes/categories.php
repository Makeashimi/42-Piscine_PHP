<div class = "categorie">
	<?php
		$categories = get_categories();
		echo "<a href='./'><strong>Accueil du magasin</strong></a>";
		foreach ($categories as $category)
			echo "<a href='./category.php?id=" . $category['id'] . "'>" . $category['name'] . "</a>";
	?>
</div>
