#!/usr/bin/php
<?php
function getHTML($url)
{
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);//return as string w/ curl_exec()
	curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
	$output = curl_exec($ch);
	curl_close($ch);
	return ($output);
}

function downloadFiles($images, $url)
{
	//website name (and now the folder's name)
	$folder = parse_url($url)['host'];

	//make folder
	if (is_dir($folder) === false)
		mkdir($folder);

	//download each file
	foreach ($images as $img)
	{
		//absolute path vs relative path
		if (filter_var($img, FILTER_VALIDATE_URL))
			$ch = curl_init($img);
		else if (filter_var($url.$img, FILTER_VALIDATE_URL))
			$ch = curl_init($url.$img);
		else 
			continue;

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, false);
		$rawdata = curl_exec($ch);
		curl_close($ch);
		file_put_contents($folder."/".basename($img), $rawdata);
	}
}


if ($argc < 2 && filter_var($argv[1], FILTER_VALIDATE_URL) === false)
	return (1);

$url = $argv[1];

//read in webpage
$webpage = getHTML($url);

//find images on page
preg_match_all('/<img\s[^>]*src\="(.*?)"[^>]*>/i', $webpage, $images);

//download images
downloadFiles($images[1], $url);
?>