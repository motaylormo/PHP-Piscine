#!/usr/bin/php
<?php
function another_world($str)
{
	$str = trim($str);
	$str = preg_replace('/\s+/', ' ', $str);
	$str = preg_replace('/\t+/', ' ', $str);
	return $str;
}
if ($argc < 2)
	return (1);
print another_world($argv[1]);
?>