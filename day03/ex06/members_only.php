<?php	//if authorized
	if ($_SERVER['PHP_AUTH_USER'] == "zaz" &&
		$_SERVER['PHP_AUTH_PW'] == "Ilovemylittleponey"):
	// this kind of setup: https://stackoverflow.com/questions/4731810/if-else-embedding-inside-html/4731827
?>
<html><body>
Hello Zaz<br />
<?php
	if (($file = file_get_contents('../img/42.png')) !== false)
		echo "<img src='data:image/png;base64,".base64_encode($file)."'>";
?>

</body></html>
<?php	//if unauthorized
	else:
		header('HTTP/1.0 401 Unauthorized');
		header('WWW-Authenticate: Basic realm=\'\'Member area\'\'');
?>
<html><body>That area is accessible for members only</body></html>
<?php endif; ?>
