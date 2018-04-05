<?php
session_start();
if ($_SESSION["logged_on_user"] != null)
	echo $_SESSION["logged_on_user"]."\n";
else
	echo "ERROR\n";
?>