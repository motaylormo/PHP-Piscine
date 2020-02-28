<?php
//https://www.php.net/manual/en/reserved.variables.get.php
foreach ($_GET as $key => $value) {
	echo ($key.":\t".$value."\n");
}
?>