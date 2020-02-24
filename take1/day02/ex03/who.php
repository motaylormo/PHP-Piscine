#!/usr/bin/php
<?php
date_default_timezone_set('America/Los_Angeles');
$fd = fopen("/var/run/utmpx", "r");
while ($file = fread($fd, 628))
{
	$data = unpack("a256user/a4id/a32line/ipid/itype/itime", $file);
	if ($data['type'] == 7)
	{
		echo str_pad(trim($data['user']), 8, " ") . " ";
		echo str_pad(trim($data['line']), 8, " ") . " ";
		$time = date("M d H:i", $data['time']);
		echo $time . " \n";
	}
}
?>