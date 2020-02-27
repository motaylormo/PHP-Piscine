#!/usr/bin/php
<?php
function read_file($arg)
{
	$fd = fopen($arg, "r") or die("Unable to open file!");
	$myfile = fread($fd, filesize($arg));
	fclose($fd);
	return $myfile;
}

if ($argc < 2)
	return (1);

$str = read_file($argv[1]);

/*
	preg_replace_callback notes:
		https://stackoverflow.com/questions/2638288/preg-replace-to-capitalize-a-letter-after-a-quote
*/
function to_caps($matches)
{
	return strtoupper($matches[0]);
}


$str = preg_replace_callback(
	'/<a\s[^>]*>(.*?)<\/a>/',//everything between <a></a>
	function ($matches) {
		return preg_replace_callback(
			//https://stackoverflow.com/questions/24244506/regex-match-everything-except-html-tags
			'/<[^>]*>(*SKIP)(*F)|[^<]+/',//everything not a tag
			"to_caps", $matches[0]);
	},
	$str);

$str = preg_replace_callback('/(<a\s.*?<\/a>)/',//everything in <a></a>
	function ($matches) {
		return preg_replace_callback(
			'/(?<=title\=)"(.*?)"/',//title=""
			"to_caps", $matches[0]);
	}, $str);

	print($str);
?>