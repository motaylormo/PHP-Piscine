#!/usr/bin/php
<?php
if ($argc < 2)
	return (1);

$data = [];
for ($i = 2; $i < $argc; $i++)
{
	$tmp = explode(':', $argv[$i]);
	$data[$tmp[0]] = $tmp[1];
}
if (array_key_exists($argv[1], $data))
	echo $data[$argv[1]]."\n";
?>