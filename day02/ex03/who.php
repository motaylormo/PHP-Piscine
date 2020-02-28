#!/usr/bin/php
<?php
date_default_timezone_set('America/Los_Angeles');

/*
	Format:
		header "3.2. Record" - https://github.com/libyal/dtformats/blob/master/documentation/Utmp%20login%20records%20format.asciidoc
		header "6.3 UTMPX File" - https://www.ma.rhul.ac.uk/static/techrep/2015/RHUL-MA-2015-8.pdf
	format codes - https://www.php.net/manual/en/function.pack.php
*/
$record_format =//				BYTES	VALUE
"a256".	"user/"//		(string)	256	Username
."a4".	"id/"//			(string)	4	Terminal indentifier
."a32".	"line/"//		(string)	32	Terminal (tty name or line)
."i".	"pid/"//				4	Process identifier (PID)
."i".	"type/"//				4*	Type of login
."i".	"timestamp/"//				4	Timestamp
."i".	"microseconds/"//			4	Microseconds
."a256"."host/"//		(string)	256	Hostname
."x64".	"padding"//		(16 ints)	64	Padding for future fields
;
$record_length = 628;

$fd = fopen("/var/run/utmpx", "r");
while ($buffer = fread($fd, $record_length))
{
	$data = unpack($record_format, $buffer);
	if ($data['type'] == 7)//	7 is USER_PROCESS
	{
		echo str_pad(trim($data['user']), 8, " ")." ";
		echo str_pad(trim($data['line']), 8, " ")." ";
		echo date("M d H:i", $data['timestamp'])."\n";
	}
}
fclose($fd);
?>
