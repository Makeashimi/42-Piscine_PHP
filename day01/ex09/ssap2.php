#!/usr/bin/php
<?php
function sort_array($mot1, $mot2)
{
    $mot1 = strtolower($mot1);
    $mot2 = strtolower($mot2);
    $i = 0;
    while ($mot1[$i] != NULL && $mot2[$i] != NULL && $mot1[$i] == $mot2[$i])
        $i++;
    return (cmp($mot1[$i]) - cmp($mot2[$i]));
}

function cmp($c)
{
    $tab = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m",
        "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z", "0", "1",
        "2", "3", "4", "5", "6", "7", "8", "9", " ", "!", "\"", "#", "$", "%",
        "&", "'", "(", ")", "*", "+", ",", "-", ".", "/", ":", ";", "<", "=", ">",
		"?", "[", "\\", "]", "^", "_", "`", "{", "|", "}", "~");
	$i = 0;
    foreach ($tab as $value)
    {
        if ($value == $c)
           return ($i);
        $i++;
    }
}

if ($argc == 1)
    return ;
$j = 0;
$i = 0;
foreach ($argv as $i)
{
    if ($i != NULL)
    {
        $i = trim($i);
        $i = preg_replace('/ +/', ' ', $i);
        $tableau = explode(" ", $i);
        foreach ($tableau as $value)
            $tab[$j++] = $value;
    }
}
array_shift($tab);
$empty = array("");
$tab = array_diff($tab, $empty);
usort($tab, sort_array);
foreach ($tab as $value)
    echo $value."\n";
?>
