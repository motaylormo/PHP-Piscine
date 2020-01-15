#!/usr/bin/php
<?php
function get_month($month)
{
	switch ($month) {
		case "Janvier": return 1;
		case "Février": return 2;
		case "Mars": return 3;
		case "Avril": return 4;
		case "Mai": return 5;
		case "Juin": return 6;
		case "Juillet": return 7;
		case "Août": return 8;
		case "Septembre": return 9;
		case "Octobre": return 10;
		case "Novembre": return 11;
		case "Décembre": return 12;
		default: return 0;
	}
}
function one_more_time($str)
{
	$date_array = explode(" ", $str);
	if (count($date_array) != 5)
		return (print("Wrong Format\r\n"));
	$month = get_month($date_array[2]);
	if ($month == 0 || !is_numeric($date_array[3]) || !is_numeric($date_array[1]))
		return (print("Wrong Format\r\n"));

	$str = $date_array[3]."-".$month."-".$date_array[1]." ".$date_array[4];
	date_default_timezone_set('Europe/Paris');
	$timestamp = strtotime($str);
	print($timestamp) ."\r\n";
}
if ($argc < 2)
	return (1);
one_more_time($argv[1]);
?>