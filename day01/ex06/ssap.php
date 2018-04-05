#!/usr/bin/php
<?php
if ($argc == 1)
    return ;
$j = 0;
$i = 0;
foreach ($argv as $i)
{
    $i = trim($i);
    $i = preg_replace('/ +/', ' ', $i);
    $tableau = explode(" ", $i);
    foreach ($tableau as $value)
        $tab[$j++] = $value;
}
array_shift($tab);
sort($tab);
foreach ($tab as $value)
	echo $value."\n";
?>
