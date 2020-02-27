#!/usr/bin/php
<?php
function do_op($a, $b, $c)
{
	switch ($b) {
		case "+":
			echo ($a + $c);
			break;
		case "-":
			echo ($a - $c);
			break;
		case "*":
			echo ($a * $c);
			break;
		case "/":
			echo ($c == 0 ? "No div by 0" : ($a / $c));
			break;
		case "%":
			echo ($c == 0 ? "No modulo by 0" : ($a % $c));
			break;
		default:
			echo "Not an accepted operand";
	}
	echo "\n";
}

if ($argc < 2)
	echo "Incorrect Parameters\n";
else
{
	$arr = preg_split('/([.\+\-\*\/\%])/', $argv[1], -1, PREG_SPLIT_DELIM_CAPTURE);
	foreach ($arr as &$value)
		$value = trim($value);
	
	if (count($arr) == 3
		&& is_numeric($arr[0]) && is_numeric($arr[2]))
		do_op($arr[0], $arr[1], $arr[2]);
	else
		echo "Syntax Error\n";
}

?>