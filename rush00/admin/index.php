<?php
	session_start();
	require_once "../dbh.php";

	require_admin();
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Admin</title>
</head>
<body>
	<h1>Administration</h1>
	<a style="font-size:2em; text-decoration:none;" href="./products.php">Gestion des produits</a><br />
	<a style="font-size:2em; text-decoration:none;" href="./users.php">Gestion des utlisateurs</a><br />
	<a style="font-size:2em; text-decoration:none;" href="./categories.php">Gestion des catégories</a><br />
	<a style="font-size:2em; text-decoration:none;" href="./orders.php">Gestion des commandes</a><br />
	<a style="font-size:2em; text-decoration:none;" href="../">← Retour à la boutique</a><br />
</body>
</html>
