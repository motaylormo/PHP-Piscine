#!/usr/bin/php
<?php
while (1)
{
	echo "Enter a number: ";
	$line = trim(fgets(STDIN));//https://www.php.net/manual/en/function.fgets.php

	//https://stackoverflow.com/questions/8094702/how-use-eof-stdin-in-c
	if (feof(STDIN))
	{
		echo "\n";
		break;
	}
	
	//https://www.php.net/manual/en/function.is-numeric.php
	if (is_numeric($line))
		echo ("The number ".$line." is ".(($line % 2) ? "odd" : "even").".\n");
	else
		echo ("'".$line."'"." is not a number.\n");
}
?>