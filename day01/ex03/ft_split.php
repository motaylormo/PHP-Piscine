<?php
function ft_split($str)
{
	$arr = explode( ' ', $str);
	//https://www.codebyamir.com/blog/removing-empty-array-elements-in-php
	$arr = array_filter($arr);
	$arr = array_values($arr);
	return ($arr);
}
?>