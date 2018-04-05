#!/usr/bin/php
<?php
if ($argc == 1)
    return ;
$argv[1] = trim($argv[1], " ");
$argv[1] = preg_replace('/ +/', ' ', $argv[1]);
$tab = explode(" ", $argv[1]);
$var = $tab[0];
array_shift($tab);
foreach ($tab as $value)
    echo $value." ";
echo $var."\n";
?>
