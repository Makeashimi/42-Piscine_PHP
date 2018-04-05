<?php
	session_start();
	require_once "./dbh.php";

	if (isset($_GET['delete'])) {
		delete_user($_SESSION['id']);
		session_destroy();
		header("Location: ./");
		exit();
	}

	if (isset($_POST['new_login'])) {
		$err = update_user_login($_POST['new_login'], $_SESSION['id']);
	}

	if (isset($_POST['old_pw']) && isset($_POST['new_pw']))
		$err = update_user_password($_POST['old_pw'], $_POST['new_pw']);
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Gaming Shop - Profile</title>
		<link rel = "stylesheet" href = "./css/presentation.css">
		<link rel = "stylesheet" href = "./css/profile.css">
		<meta charset = "utf-8">
	</head>
	<body>
		<?php require_once("./includes/navbar.php"); ?>
		<br/>

		<?php
			if (isset($err))
				echo '<center><br/><br/><br/><h1 style="color:white;">' . $err . '</h1></center>';
		?>

		<div class="wrap">
			<a href="./">
				<div class="back">
					Retour<br />
					au site
				</div>
			</a>

			<div class="delete" id="delete">
				Supprimer mon<br />
				compte
			</div>

			<div class="edit_1">
				Modifier mon identifiant<br />
				<form method="post">
					<input type="text" name="new_login" placeholder="New login"/><br />
					<input type="submit" value="Go !"/>
				</form>
			</div>

			<div class="edit_2">
				Modifier mon <br />mot de passe<br />
				<form method="post">
					<input type="pass" name="old_pw" placeholder="Old Password"/><br />
					<input type="pass" name="new_pw" placeholder="New Password"/><br />
					<input type="submit" value="Go !"/>
				</form>
			</div>
		</div>

		<script>
			var del = document.getElementById("delete");

			del.onclick = function() {
				var c = confirm("Vous êtes certain ?");
				if (c) {
					document.location.href = "./profile.php?delete=yes";
				}
			}
		</script>
	</body>
</html>
