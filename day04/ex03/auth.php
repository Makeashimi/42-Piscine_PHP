<?php
function auth($login, $passwd)
{
	$account = unserialize(file_get_contents("../private/passwd"));
	if ($account == null)
		return false;
	foreach ($account as $value)
	{
		if ($value["login"] == $login && hash("whirlpool", $passwd) == $value["passwd"])
			return true;
	}
	return false;
}
?>