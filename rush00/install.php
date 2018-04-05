<?php

require_once "./dbh.php";
mysqli_multi_query($GLOBALS['dbh'], file_get_contents("sql.sql")) or die(mysqli_error($GLOBALS['dbh']));

?>

<h1>Installation was successful ! :)</h1>
<a href="./">Go to the website.</a>
