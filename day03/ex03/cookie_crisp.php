<?php
if (isset($_GET["action"]) != false && isset($_GET["value"]) != false && isset($_GET["name"]) != false && $_GET["action"] == "set" && $_GET["name"] != null && $_GET["value"] != null)
{
	setcookie($_GET["name"], $_GET["value"]);
}
if (isset($_GET["action"]) != false && isset($_GET["name"]) != false && isset($_COOKIE[$_GET["name"]]) != false && $_GET["action"] == "get" && $_GET["name"] != null && $_COOKIE[$_GET["name"]] != null)
{
	echo $_COOKIE[$_GET["name"]]."\n";
}
if (isset($_GET["action"]) != false && isset($_GET["name"]) != false && $_GET["action"] == "del" && $_GET["name"] != null)
{
	setcookie($_GET["name"], "", 1);
}
?>