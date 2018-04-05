<?php

date_default_timezone_set("Europe/Paris");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define("MYSQL_HOST", "localhost");
define("MYSQL_USER", "root");
define("MYSQL_PASS", "rootroot");
define("MYSQL_DB", "rush");

$GLOBALS['dbh'] = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASS, MYSQL_DB);

function is_signed_in() {
	return isset($_SESSION['id']);
}

function create_order() {
	$cart = get_cart();

	if (count($cart['products']) === 0)
		return;

	mysqli_query($GLOBALS['dbh'],
	"INSERT INTO `orders` (`id`, `user_id`, `date`) VALUES (NULL, '" . $_SESSION['id'] . "', " . time() . ");");

	$order_id = mysqli_insert_id($GLOBALS['dbh']);
	foreach ($cart['products'] as $product) {
		mysqli_query($GLOBALS['dbh'],
		"INSERT INTO `order_product` (`id`, `id_order`, `id_product`, `qte`)
		VALUES (NULL, '" . $order_id . "', '" . $product['id'] . "', '" . $product['qte'] . "');");
	}

	$cart = array("products" => array(),"total_price" => 0.0);
	update_cart($cart);
}

function get_orders() {
	$arr = array();

	$res = mysqli_query($GLOBALS['dbh'], "SELECT o.*, u.`username` FROM `orders` o
										  INNER JOIN `users` u ON u.`id` = o.`user_id`
										  ORDER BY o.`date` DESC;");
	while ($row = mysqli_fetch_assoc($res)) {
		$res2 = mysqli_query($GLOBALS['dbh'], "SELECT p.`id`, p.`name`, op.`qte`, p.`price` as `unit_price`, op.`qte` * p.`price` as `total_price`
				FROM `order_product` op
				INNER JOIN `product` p ON p.`id` = op.`id_product`
				WHERE `id_order` = " . $row['id']);
		array_push($arr, array(
			"user_id" => $row['user_id'],
			"username" => $row['username'],
			"date" => $row['date'],
			"id" => $row['id'],
			"products" => make_assoc_all($res2)
		));
	}

	return ($arr);
}

function get_cart() {
	if (!isset($_SESSION['cart']))
		$_SESSION['cart'] = "";
	$arr = unserialize($_SESSION['cart']);
	if ($arr === false)
		return array(
			"products" => array(),
			"total_price" => 0.0
		);
	return $arr;
}

function remove_cart_qte($id) {
	$cart = get_cart();

	for($i = 0; $i < count($cart['products']); $i++) {
		$item = $cart['products'][$i];
		if ($item['id'] === $id) {
			$cart['total_price'] -= ($item['qte'] * $item['unit_price']);
			array_splice($cart['products'], $i, 1);
			update_cart($cart);
		}
	}
}

function add_to_cart($id, $qte, $unit_price) {
	$cart = get_cart();

	foreach ($cart['products'] as &$item) {
		if ($item['id'] === $id)
		{
			$item['qte'] += $qte;
			$cart['total_price'] += ($unit_price * $qte);
			update_cart($cart);
			return ;
		}
	}
	array_push($cart['products'], array(
		"id" => $id,
		"qte" => $qte,
		"unit_price" => $unit_price
	));

	$cart['total_price'] += ($unit_price * $qte);
	update_cart($cart);
}

function update_cart_qte($id, $qte) {
	$cart = get_cart();

	foreach ($cart['products'] as &$item) {
		if ($item['id'] === $id) {
			$cart['total_price'] -= ($item['unit_price'] * $item['qte']);
			$item['qte'] = $qte;
			$cart['total_price'] += ($item['unit_price'] * $item['qte']);
			update_cart($cart);
			return ;
		}
	}
}

function update_cart($cart) {
	$_SESSION['cart'] = serialize($cart);
}

function make_assoc_all($res) {
	$arr = array();
	while (($row = mysqli_fetch_assoc($res))) {
		array_push($arr, $row);
	}
	return ($arr);
}

function sign_user_in($username, $password) {
	$username = htmlentities(mysqli_real_escape_string($GLOBALS['dbh'], $username));
	$password = htmlentities(mysqli_real_escape_string($GLOBALS['dbh'], $password));

	$res = mysqli_query($GLOBALS['dbh'],
						"SELECT * FROM `users`
		 				WHERE 	`users`.`username` = '" . $username . "'
						AND		`users`.`password` = '" . hash("sha256", $password) . "';");
	$row = mysqli_fetch_assoc($res);
	if (is_array($row)) {
		$_SESSION['login'] = $row['username'];
		$_SESSION['rank'] = $row['rank'];
		$_SESSION['id'] = $row['id'];
		return true;
	}
	return (false);
}

function sign_user_up($username, $password) {
	$username = htmlentities(mysqli_real_escape_string($GLOBALS['dbh'], $username));
	$password = htmlentities(mysqli_real_escape_string($GLOBALS['dbh'], $password));

	$res = mysqli_query($GLOBALS['dbh'],
						"SELECT COUNT(*) as `count` FROM `users` WHERE `users`.`username` = '" . $username . "';");
	if (mysqli_fetch_assoc($res)['count'] != "0")
		return false;
	$res = mysqli_query($GLOBALS['dbh'],
						"INSERT INTO `users` (`id`, `username`, `password`, `rank`)
						VALUES(NULL, '" . $username . "', '" . hash("sha256", $password) . "', 'user')")  or die(mysqli_error($GLOBALS['dbh']));
	$_SESSION['login'] = $username;
	$_SESSION['rank'] = "user";
	$_SESSION['id'] = mysqli_insert_id($GLOBALS['dbh']);
	return true;
}

function get_categories() {
	$res = mysqli_query($GLOBALS['dbh'], "SELECT * FROM `category`;");
	return make_assoc_all($res);
}

function get_products() {
	$res = mysqli_query($GLOBALS['dbh'], "SELECT * FROM `product`;");
	return make_assoc_all($res);
}

function get_shuffled_products() {
	$arr = get_products();
	shuffle($arr);
	return ($arr);
}

function create_category($name) {
	$name = htmlentities(mysqli_real_escape_string($GLOBALS['dbh'], $name));
	mysqli_query($GLOBALS['dbh'], "INSERT INTO `category` (`id`, `name`) VALUES (NULL, '" . $name . "')");
}

function delete_category($id) {
	$id = htmlentities(mysqli_real_escape_string($GLOBALS['dbh'], $id));
	mysqli_query($GLOBALS['dbh'], "DELETE FROM `category` WHERE `id` = '" . $id . "';") or die(mysqli_error($GLOBALS['dbh']));
	mysqli_query($GLOBALS['dbh'], "DELETE FROM `category_products` WHERE `id_category` = '" . $id . "';") or die(mysqli_error($GLOBALS['dbh']));
}

function get_products_in_category($c_id) {
	$c_id = htmlentities(mysqli_real_escape_string($GLOBALS['dbh'], $c_id));
	$res = mysqli_query($GLOBALS['dbh'], "SELECT * FROM `product` `p` WHERE EXISTS (SELECT * FROM `category_products` `cp` WHERE `cp`.`id_product` = `p`.`id` AND `cp`.`id_category` = " . $c_id . ")");
	return make_assoc_all($res);
}

function get_product_by_id($p_id) {
	$p_id = htmlentities(mysqli_real_escape_string($GLOBALS['dbh'], $p_id));
	$res = mysqli_query($GLOBALS['dbh'], "SELECT * FROM `product` WHERE `product`.`id` = '" . $p_id . "'");
	return mysqli_fetch_assoc($res);
}

function get_users() {
	$res = mysqli_query($GLOBALS['dbh'], "SELECT `username`, `id`, `rank` FROM `users`;");
	return make_assoc_all($res);
}

function delete_user($id) {
	$id = htmlentities(mysqli_real_escape_string($GLOBALS['dbh'], $id));
	mysqli_query($GLOBALS['dbh'], "DELETE FROM `users` WHERE `id` = " . $id);
}

function search_product($search) {
	$search = htmlentities(mysqli_real_escape_string($GLOBALS['dbh'], $search));
	$res = mysqli_query($GLOBALS['dbh'], "SELECT * FROM `product` WHERE `product`.`name` LIKE '%" . $search ."%';");
	return make_assoc_all($res);
}

function require_admin() {
	if (!isset($_SESSION['login']) || !isset($_SESSION['rank']) || $_SESSION['rank'] !== "admin")
		header("Location: ../");
}

function set_user_rank($id, $isAdmin) {
	if ($isAdmin)
		mysqli_query($GLOBALS['dbh'], "UPDATE `users` SET `rank` = 'admin' WHERE `id` = " . $id . ";");
	else
		mysqli_query($GLOBALS['dbh'], "UPDATE `users` SET `rank` = 'user' WHERE `id` = " . $id . ";");
}

function get_product_categories($id) {
	$id = htmlentities(mysqli_real_escape_string($GLOBALS['dbh'], $id));
	$res = mysqli_query($GLOBALS['dbh'],
	"SELECT c.`id`, c.`name`,
		(SELECT EXISTS(
    		SELECT * FROM `category_products` cp
    		WHERE cp.`id_category` = c.`id`
    		AND cp.`id_product` = " . $id . "
		) ) as active
	FROM `category` c"
	);
	return make_assoc_all($res);
}

function delete_product($id) {
	$id = htmlentities(mysqli_real_escape_string($GLOBALS['dbh'], $id));
	mysqli_query($GLOBALS['dbh'], "DELETE FROM `product` WHERE `id` = " . $id) or die(mysqli_error($GLOBALS['dbh']));
	mysqli_query($GLOBALS['dbh'], "DELETE FROM `category_products` WHERE `id_product` = " . $id) or die(mysqli_error($GLOBALS['dbh']));
}

function update_product($id, $name, $description, $img_url, $categories, $price) {
	$id = htmlentities(mysqli_real_escape_string($GLOBALS['dbh'], $id));
	$name = htmlentities(mysqli_real_escape_string($GLOBALS['dbh'], $name));
	$description = htmlentities(mysqli_real_escape_string($GLOBALS['dbh'], $description));
	$img_url = htmlentities(mysqli_real_escape_string($GLOBALS['dbh'], $img_url));
	$price = htmlentities(mysqli_real_escape_string($GLOBALS['dbh'], $price));

	mysqli_query($GLOBALS['dbh'],
	"UPDATE `product`
		SET `product`.`name` = '" . $name . "',
		`product`.`description` = '" . $description . "',
		`product`.`img_url` = '" . $img_url . "',
		`product`.`price` = '" . $price . "'
		WHERE `id` = " . $id);
	mysqli_query($GLOBALS['dbh'],
	"DELETE FROM `category_products` WHERE `id_product` = " . $id);

	$sql = "INSERT INTO `category_products` (`id`, `id_product`, `id_category`) VALUES ";
	foreach ($categories as $category) {
		$category = htmlentities(mysqli_real_escape_string($GLOBALS['dbh'], $category));
		$sql .= "(NULL, '" . $id ."', '" . $category ."'),";
	}
	$sql = substr($sql, 0, -1);
	mysqli_query($GLOBALS['dbh'], $sql);
}

function create_product($name, $description, $img_url, $categories, $price) {
	$name = htmlentities(mysqli_real_escape_string($GLOBALS['dbh'], $name));
	$description = htmlentities(mysqli_real_escape_string($GLOBALS['dbh'], $description));
	$img_url = htmlentities(mysqli_real_escape_string($GLOBALS['dbh'], $img_url));
	$price = htmlentities(mysqli_real_escape_string($GLOBALS['dbh'], $price));

	mysqli_query($GLOBALS['dbh'],
	"INSERT INTO `product` (`id`, `name`, `description`, `img_url`, `price`)
	VALUE(NULL, '" . $name . "', '" . $description . "', '" . $img_url . "', '" . $price . "');");

	$sql = "INSERT INTO `category_products` (`id`, `id_product`, `id_category`) VALUES ";
	foreach ($categories as $category) {
		$category = htmlentities(mysqli_real_escape_string($GLOBALS['dbh'], $category));
		$sql .= "(NULL, '" . mysqli_insert_id($GLOBALS['dbh']) ."', '" . $category ."'),";
	}
	$sql = substr($sql, 0, -1);
	mysqli_query($GLOBALS['dbh'], $sql);
}

function update_user_login($new_login, $uid) {
	$new_login = htmlentities(mysqli_real_escape_string($GLOBALS['dbh'], $new_login));

	if ($new_login === "")
		return "Erreur: Merci de remplir tous les champs.";

	$res = mysqli_query($GLOBALS['dbh'],
						"SELECT COUNT(*) as `count` FROM `users` WHERE `users`.`username` = '" . $new_login . "';");
	if (mysqli_fetch_assoc($res)['count'] != "0")
		return "Erreur: Ce nom d'utilisateur est déjà utilisé.";
	$res = mysqli_query($GLOBALS['dbh'], "UPDATE `users` SET `users`.`username` = '" . $new_login . "' WHERE `users`.`id` = " . $uid);
	$_SESSION['login'] = $new_login;
	return "Modification effectuée :)";
}

function update_user_password($old_pw, $new_pw) {
	$old_pw = htmlentities(mysqli_real_escape_string($GLOBALS['dbh'], $old_pw));
	$new_pw = htmlentities(mysqli_real_escape_string($GLOBALS['dbh'], $new_pw));

	if ($old_pw === "" || $new_pw === "")
		return "Merci de remplir tous les champs.";

	$res = mysqli_query($GLOBALS['dbh'],
						"SELECT * FROM `users`
		 				WHERE 	`users`.`username` = '" . $_SESSION['login'] . "'
						AND		`users`.`password` = '" . hash("sha256", $old_pw) . "';");
	$row = mysqli_fetch_assoc($res);
	if (is_array($row)) {
		mysqli_query($GLOBALS['dbh'],
		"UPDATE `users` SET `users`.`password` = '" . hash("sha256", $new_pw) . "'
		WHERE `users`.`id` = " . $_SESSION['id']);
		return "Modification effectuée :)";
	} else {
		return "Erreur: L'ancien mot de passe ne correspond pas.";
	}
}

function update_user_pw_noconfirm($uid, $new_pw) {
	$uid = htmlentities(mysqli_real_escape_string($GLOBALS['dbh'], $uid));
	$new_pw = htmlentities(mysqli_real_escape_string($GLOBALS['dbh'], $new_pw));

	mysqli_query($GLOBALS['dbh'], "UPDATE `users` SET `users`.`password` = '" . hash("sha256", $new_pw) . "' WHERE `users`.`id` = " . $uid);
	return "Ok :)";
}
