<?php

// Signin - Signup
if (isset($_POST['submit'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];

	if ($username === "" || $password === "")
		$err = "All fields are required.";
	else {
		if ($_POST['submit'] === "Se connecter") {
			if (!sign_user_in($username, $password)) {
				$err = "Nom d'utilisateur et/ou mot de passe invalide.";
			}
		} else if ($_POST['submit'] === "Créer un compte") {
			if (!sign_user_up($username, $password)) {
				$err = "Ce nom d'utilisateur est déjà utilisé.";
			}
		}
	}
} // / Signin - Signup

?>


<form method="post" class="user_form">
	<?php
		if (isset($_SESSION['login']) && $_SESSION['rank'] === "admin") {
			echo "Connecté (<a href='./profile.php'>" . $_SESSION['login'] . "</a>). <a href='./signout.php'>Déconnexion</a> - <a href='./admin'>Administration</a>";
		} else if (isset($_SESSION['login'])) {
			echo "Connecté (<a href='./profile.php'>" . $_SESSION['login'] . "</a>). <a href='./signout.php'>Déconnexion</a>";
		} else {
			if (isset($err))
				echo "<strong class='logerr'>" . $err . "</strong><br />";
			?>
			<input name="username" class = "login" type = "text" placeholder = "Identifiant">
			<input name="password" class = "mdp" type = "password" placeholder = "Mot de passe">
			<input name="submit" class = "connecter" type = "submit" value = "Se connecter">
			<input name="submit" class = "creer" type = "submit" value = "Créer un compte">
		<?php
		}
		?>
</form>
