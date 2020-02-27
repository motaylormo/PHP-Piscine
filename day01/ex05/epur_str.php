#!/usr/bin/php
<?php
if ($argc < 2)
	return (1);

$line = trim($argv[1]);// "none at the beginning and at the end of the string"
$arr = preg_split("/ +/", $line);//https://www.php.net/manual/en/function.preg-split.php
echo implode(" ", $arr)."\n";
?>