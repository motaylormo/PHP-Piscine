#!/usr/bin/php
<?php
if ($argc < 2)
	return (1);
unset($argv[0]);//	"(except the name of the program itself)"

$longline = implode(" ", $argv);//	merge them all, even multi-word args
$arr = preg_split("/ +/", trim($longline));//	re-split them
if (empty(array_filter($arr)))
	return (1);//	for example, if the only arg was "  "

sort($arr);
foreach ($arr as &$value)
	echo $value."\n";
?>