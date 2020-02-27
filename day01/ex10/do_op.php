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
			echo ($a / $c);
			break;
		case "%":
			echo ($a % $c);
			break;
	}
	echo "\n";
}

if ($argc == 4)
	do_op(trim($argv[1]), trim($argv[2]), trim($argv[3]));
?>