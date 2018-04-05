<?php
	session_start();
	require_once "../dbh.php";

	require_admin();
	setlocale(LC_TIME, array('fr_FR.UTF-8','fr_FR@euro','fr_FR','french'));
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Admin - Commandes</title>
</head>
<body>
	<h3><a href="./">← Retour</a></h3>	
	<h1>Liste des commandes: </h1>

	<?php
	$orders = get_orders();
	foreach ($orders as $order) {
		?>

		<h3>Commande #<?php echo $order['id']; ?></h3>
		Commandé par: <?php echo $order['username']; ?>, le <?php echo strftime("%A %e %B %G à %k:%M:%S", $order['date']); ?>
		<br />
		<ul>
		<?php
		$total = 0;
		foreach ($order['products'] as $product) {
			echo "<li>" . $product['qte'] . " x " . $product['name'] . " (" . number_format($product['unit_price'], 2) . "€) = " . number_format($product['total_price'], 2) . "€</li>";
			$total += (float)$product['total_price'];
		}
		echo '</ul>';

		echo '<h3>Prix total: ' . number_format($total, 2) . '€</h3>';

		echo '<hr />';
	}
	?>
</body>
</html>
