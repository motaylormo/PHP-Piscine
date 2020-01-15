#!/usr/bin/php
<?php
function replace_titles($str)
{
	$pattern = '/title="(.+)"/';
	preg_match_all($pattern, $str, $array);

	foreach($array[1] as &$value)
		$value = "title=\"" . strtoupper($value) . "\"";

	$str = str_replace($array[0], $array[1], $str);
	return ($str);
}
function replace_link_text($str)
{
	$pattern = '/<a href=.*?>(.*)<\/a>/';
	preg_match_all($pattern, $str, $array);

	foreach($array[0] as &$link)
	{
		$temp = strtoupper($link);//whole thing to uppercase

		preg_match_all('/(<.*?>)/', $link, $tags);//find all tags (orig)
		foreach($tags[1] as &$t)
			$t = strtoupper($t);//make upcase versions of those tags

		$temp = str_replace($tags[1], $tags[0], $temp);//replace uppercase tags with orig tags
		$str = str_replace($link, $temp, $str);
	}
	return ($str);
}
function read_file($arg)
{
	$fd = fopen($arg, "r") or die("Unable to open file!");
	$myfile = fread($fd, filesize($arg));
	fclose($fd);
	return $myfile;
}
if ($argc < 2)
	return (1);

$myfile = read_file($argv[1]);
$myfile = replace_titles($myfile);
$myfile = replace_link_text($myfile);
	print($myfile);
?>