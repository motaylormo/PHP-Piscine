#!/usr/bin/php
<?php
date_default_timezone_set('Europe/Paris');
setlocale(LC_ALL, 'fr_FR');
/* 5 pieces, 4 spaces
	day of the week	-	complete/full
	day of month	-	1 or 2 characters
	month			-	complete/full
	year			-	4 digits
	hours, minutes, seconds	-	each 2 figures
*/
$format = '%A %d %B %Y %H:%M:%S';

if ($argc < 2)
	return (1);

if (($date = strptime($argv[1], $format)) === false)
	echo "Wrong Format\n";
else
{
	//https://www.php.net/manual/en/function.mktime.php
	$unix_timestamp = mktime(
							$date['tm_hour'],
							$date['tm_min'],
							$date['tm_sec'],
							($date['tm_mon'] + 1),
							$date['tm_mday'],
							($date['tm_year'] + 1900)
						);
	echo $unix_timestamp."\n";
}
?>