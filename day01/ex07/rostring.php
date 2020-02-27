#!/usr/bin/php
<?php
if ($argc < 2)
	return (1);

$arr = preg_split("/ +/", trim($argv[1]));

//remove first element - https://www.php.net/manual/en/function.array-shift.php
$first = array_shift($arr);
//append to end - https://www.php.net/manual/en/function.array-push.php
array_push($arr, $first);

echo implode(" ", $arr)."\n";
?>