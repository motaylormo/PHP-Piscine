<?php
function ft_is_sort($tab)
{
	$copy =  array_values($tab);
	sort($copy);
	return ($tab === $copy);
}
?>