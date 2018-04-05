#!/usr/bin/php
<?php
function ft_split($string)
{
	$string = trim($string, " ");
	$string = preg_replace("/[ ]+/", " ", $string);
	$tableau = explode(" ", $string);
	sort($tableau);
	return ($tableau);
}
?>
