<?php
if (!$_GET['action'] || !$_GET['name'])
	return;

switch ($_GET['action'])
{
	case 'set':
		if ($_GET['value'])
			setcookie($_GET['name'], $_GET['value'], time() + 3600);// 3600 seconds = 1 hour
		break;
	case 'get':
		// don't want to print the newline if there's no cookie
		if ($_COOKIE[$_GET['name']])
			echo $_COOKIE[$_GET['name']]."\n";
		break;
	case 'del':
		setcookie($_GET['name'], '', time() - 3600);
		break;
}
?>