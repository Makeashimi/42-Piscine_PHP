<?php
if (isset($_POST["login"]) == true && isset($_POST["oldpw"]) == true && isset($_POST["newpw"]) == true && isset($_POST['submit']) == true)
{
	if ($_POST["login"] != null && $_POST["oldpw"] != null && $_POST["newpw"] != null && $_POST['submit'] != null && $_POST['submit'] == 'OK')
	{
		$account = unserialize(file_get_contents("../private/passwd"));
		$exist = 0;
		if ($account != null)
		{
			foreach ($account as $key => $value)
			{
				if ($value["login"] == $_POST["login"])
				{
					if ($value["passwd"] == hash("whirlpool", $_POST["oldpw"]) && $_POST["oldpw"] != $_POST["newpw"])
					{
						$exist = 1;
						$index = $key;
					}
				}
			}
		}
		if ($exist == 0)
			echo "ERROR\n";
		else
		{
			$account[$index]["passwd"] = hash("whirlpool", $_POST["newpw"]);
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