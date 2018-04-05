<?php
function ft_is_sort($tab)
{
	$i = 0;
	$copy = $tab;
	sort($tab);
	foreach ($tab as $value)
	{
		if (strcmp($value, $copy[$i++]) != 0)
			return false;
	}
	return true;
}
?>