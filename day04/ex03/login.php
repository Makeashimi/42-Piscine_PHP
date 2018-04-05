<?php
include "auth.php";

session_start();
if (isset($_GET["login"]) == true && isset($_GET["passwd"]) == true && $_GET["login"] != null && $_GET["passwd"] != null)
{
	if (auth($_GET["login"], $_GET["passwd"]) == true)
	{
		$_SESSION["logged_on_user"] = $_GET["login"];
		echo "OK\n";
	}
	else
	{
		$_SESSION["logged_on_user"] = "";
		echo "ERROR\n";
	}
}
else
{
	$_SESSION["logged_on_user"] = "";
	echo "ERROR\n";
}

?>