#!/usr/bin/php
<?php
if ($argc != 2)
{
	echo "Incorrect Parameters\n";
	return ;
}
$tab = sscanf($argv[1], "%d %c %d %s");
if ($tab[1] != "+" && $tab[1] != "-" && $tab[1] != "/" && $tab[1] != "*" && $tab[1] != "%")
{
    echo "Syntax Error\n";
    return ;
}
if (is_numeric($tab[0]) == false || is_numeric($tab[2]) == false || $tab[3] != null)
{
    echo "Syntax Error\n"; 
    return ;
}
if ($tab[1] == "+")
    echo $tab[0] + $tab[2]."\n";
else if ($tab[1] ==  "-")
    echo $tab[0] - $tab[2]."\n";
else if ($tab[1] == "*")
    echo $tab[0] * $tab[2]."\n";
else if ($tab[1] == "/")
    echo $tab[0] / $tab[2]."\n";
else if ($tab[1] ==  "%")
    echo $tab[0] % $tab[2]."\n";
?>