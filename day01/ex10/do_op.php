#!/usr/bin/php
<?php
if ($argc != 4)
{
    echo "Incorrect Parameters\n";
    return ;
}
$argv[1] = trim($argv[1]);
$argv[2] = trim($argv[2]);
$argv[3] = trim($argv[3]);
if ($argv[2] == "+")
    echo $argv[1] + $argv[3]."\n";
else if ($argv[2] == "-")
    echo $argv[1] - $argv[3]."\n";
else if ($argv[2] == "*")
    echo $argv[1] * $argv[3]."\n";
else if ($argv[2] == "/")
    echo $argv[1] / $argv[3]."\n";
else if ($argv[2] == "%")
    echo $argv[1] % $argv[3]."\n";
?>