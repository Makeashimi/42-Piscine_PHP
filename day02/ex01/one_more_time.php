#!/usr/bin/php
<?php
date_default_timezone_set("Europe/Paris");

function get_month($string)
{
    $string = strtolower($string);
    $year = array("janvier", "février", "mars", "avril", "mai", "juin", "juillet", "aout", "septembre", "octobre", "novembre", "decembre");
    $i = 1;
    foreach ($year as $month)
    {
        if (strcmp($string, $month) == 0)
            return ($i);
        $i++;
    }
}

if ($argc == 2)
{
    $tab = explode(" ", $argv[1]);
    if (count($tab) != 5)
    {
        echo ("Wrong Format\n");
        return ;
    }
    if (preg_match("/^([l|L]undi|[m|M]ardi|[m|M]ercredi|[j|J]eudi|[v|V]endredi|[s|S]amedi|[d|D]imanche)$/", $tab[0]) == false)
    {
        echo ("Wrong Format\n");
        return ;
    }
    if (preg_match("/^[0-9]{1,2}$/", $tab[1]) == false)
    {
        echo ("Wrong Format\n");
        return ;
    }
    if (preg_match("/^([j|J]anvier|[f|F]évrier|[m|M]ars|[a|A]vril|[m|M]ai|[j|J]uin|[j|J]uillet|[a|A]oût|[s|S]eptembre|[o|O]ctobre|[n|N]ovembre|[d|D]écembre)$/", $tab[2]) == false)
    {
        echo ("Wrong Format\n");
        return ;
    }
    if (preg_match("/^(\d\d\d\d)$/", $tab[3]) == false)
    {
        echo ("Wrong Format\n");
        return ;
    }
    if (preg_match("/^(\d\d:\d\d:\d\d)$/", $tab[4]) == false)
    {
        echo ("Wrong Format\n");
        return ;
    }
    sscanf($tab[4], "%d:%d:%d", $hours, $minutes, $seconds);
    echo mktime($hours, $minutes, $seconds, get_month($tab[2]), $tab[1], $tab[3])."\n";
}
?>