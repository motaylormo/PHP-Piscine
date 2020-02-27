#!/usr/bin/php
<?php
function redo_args($args)
{
	$longline = implode(" ", $args);
	$arr = preg_split("/ +/", $longline);
	array_filter($arr);
	return (array_values($arr));
}

function ordinal_val($c)
{
	$order = "abcdefghijklmnopqrstuvwxyz0123456789";
	$pos = stripos($order, $c);//case-insensitive

	if ($pos === false)//if it's not in string (aka punctuation)
		$pos = ord($c);//then ASCII value
	return ($pos);
}

function cmp($a, $b)
{
	$a_len = strlen($a);
	$b_len = strlen($b);
	for ($i = 0; ($i < $a_len) && ($i < $b_len); $i++)
	{
		$a_val = ordinal_val($a[$i]);
		$b_val = ordinal_val($b[$i]);
		if ($a_val < $b_val)
			return (-1);
		else if ($a_val > $b_val)
			return (1);
	}
	return ($a_len - $b_len);
}

if ($argc < 2)
	return (1);
unset($argv[0]);
$arr = redo_args($argv);

usort($arr, "cmp");

foreach ($arr as &$value)//print each word
	echo $value."\n";
?>