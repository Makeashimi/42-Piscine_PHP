<?php
session_start();
if (isset($_SESSION["login"]) && isset($_SESSION["passwd"]) && $_SESSION["login"] && $_SESSION["passwd"])
{
	if (isset($_GET["submit"]) && $_GET["submit"] == "OK")
	{
		$_SESSION["login"] = $_GET["login"];
		$_SESSION["passwd"] = $_GET["passwd"];
	}
}
elseif (isset($_GET["login"]) && isset($_GET["passwd"]) && $_GET["login"] != null && $_GET["passwd"] != null)
{
	$_SESSION["login"] = $_GET["login"];
	$_SESSION["passwd"] = $_GET["passwd"];
}
?>

<html>
	<body>
	<form method = "get" action = "index.php">
		<div>
			Identifiant : <input name = "login" type = "text" value = "<?php echo $_SESSION["login"] ?>">
			<br/>
			Mot de passe : <input name = "passwd" type = "password" value = "<?php echo $_SESSION["passwd"] ?>">
			<input type = "submit" value = "OK">
		</div>
	</form>		
	</body>
</html>
