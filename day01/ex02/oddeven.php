#!/usr/bin/php
<?php
while (42)
{
	echo "Entrez un nombre: ";
	$nombre = trim(fgets(STDIN));
	if (feof(STDIN) == true)
		return ;
	if (is_numeric($nombre) == true)
	{
		if ($nombre[strlen($nombre) - 1] % 2 == 0)
			echo "Le chiffre {$nombre} est Pair\n";
		else
			echo "Le chiffre {$nombre} est Impair\n";
		continue ;
	}
	echo "'{$nombre}' n'est pas un chiffre\n";
}
?>
