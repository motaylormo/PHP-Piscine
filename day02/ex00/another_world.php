#!/usr/bin/php
<?php
if ($argc < 2)
	return (1);
echo preg_replace('/[\t\s]+/', ' ', trim($argv[1]))."\n";
?>