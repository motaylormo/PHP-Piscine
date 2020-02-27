#!/usr/bin/php
<?php
date_default_timezone_set('America/Los_Angeles');
$fd = fopen("/var/run/utmpx", "r");
while ($buffer = fread($fd, 628))
{
	$data = unpack("a256user/a4id/a32line/ipid/itype/itime", $buffer);
	if ($data['type'] == 7)
	{
		echo str_pad(trim($data['user']), 8, " ")." ";
		echo str_pad(trim($data['line']), 8, " ")." ";
		echo date("M d H:i", $data['time'])." \n";
	}
}
fclose($fd);
?>