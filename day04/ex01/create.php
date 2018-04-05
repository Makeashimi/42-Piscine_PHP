<?php
if(isset($_POST['login']) == true && isset($_POST['passwd']) == true && isset($_POST['submit']) == true)
{
	if ($_POST['login'] != null && $_POST['passwd'] != null && $_POST['submit'] != null && $_POST['submit'] == 'OK')
	{
		if (file_exists("../private") == false)
			mkdir("../private");
		if (file_exists("../private/passwd") == false)
			file_put_contents("../private/passwd", null);
		$account = unserialize(file_get_contents("../private/passwd"));
		$exist = 0;
		if ($account != null)
		{
			foreach ($account as $value)
			{
				if ($value["login"] == $_POST["login"])
					$exist = 1;
			}
		}
		if ($exist == 1)
			echo "ERROR\n";
		else
		{
			$tab["login"] = $_POST["login"];
			$tab["passwd"] = hash("whirlpool", $_POST["passwd"]);
			$account[] = $tab;
			file_put_contents("../private/passwd", serialize($account));
			echo "OK\n";
		}
	}
	else
		echo "ERROR\n";
}
else
	echo "ERROR\n";
?>