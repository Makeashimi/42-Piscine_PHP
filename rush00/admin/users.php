<?php
	session_start();
	require_once "../dbh.php";

	require_admin();

	if (isset($_POST['delete'])) {
		delete_user($_POST['id']);
		echo "User was successfully deleted! <br /><br />";
	} else if (isset($_POST['update'])) {
		set_user_rank($_POST['id'], (int)$_POST['isadmin']);

		if ($_POST['old_login'] !== $_POST['newlogin'])
			$err = update_user_login($_POST['newlogin'], $_POST['id']);
		if ($_POST['newpw'] !== "")
			$err = update_user_pw_noconfirm($_POST['id'], $_POST['newpw']);
	} else if (isset($_POST['submit'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];

		if ($username !== "" || $password !== "") {
			if (!sign_user_up($username, $password)) {
				$err = "Ce nom d'utilisateur est déjà utilisé.";
			}
		}
	}

	$users = get_users();
?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Admin - Utilisateurs</title>
</head>
<body>
	<h3><a href="./">← Retour</a></h3>

	<?php if (isset($err)) echo $err; ?>

	<h3>Créer un nouvel utilisateur</h3>

	<form method="post" style="border:1px solid black; padding:10px">
		<input name="username" type = "text" placeholder = "Identifiant">
		<input name="password" type = "password" placeholder = "Mot de passe">
		<input name="submit" type = "submit" value = "Créer">
	</form>





	<h3>Gestion des utilisateurs</h3>

	<?php
	foreach ($users as $user) {
		?>
			<form method="post" style="border:1px solid black; padding:10px">
				<input type="hidden" name="id" value="<?php echo $user['id']; ?>"/>
				<input type="text" name="newlogin" value="<?php echo $user['username']; ?>" />
				<input type="password" name="newpw" placeholder="Nouveau mot de passe" />

				<input type="hidden" name="old_login" value="<?php echo $user['username']; ?>" />

				<br/><br/>
				<input type="radio" id="isadmin" name="isadmin" value="0" <?php if ($user['rank'] === "user") echo "checked"; ?>> User
				<input type="radio" id="isadmin" name="isadmin" value="1" <?php if ($user['rank'] === "admin") echo "checked"; ?>> Admin

				<br/><br/>
				<input type="submit" name="update" value="Modifier"/>
				<input type="submit" name="delete" value="Supprimer"/>
			</form>
		<?php
	}
	?>
</body>
</html>
