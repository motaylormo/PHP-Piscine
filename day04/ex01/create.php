<?php
$path = "./htdocs/private/";
$file = $path."passwd";

function	check_if_user_already_exists($file, $curr_login)
{
	if (file_exists($file)
		&& ($data = unserialize(file_get_contents($file))))
	{
		foreach ($data as $login=>$value)
		{
			if ($value['login'] == $curr_login)
				exit("ERROR\n");
		}
	}
}

function	put_data($path, $file, $arr)
{
	if (!file_exists($path))
		mkdir($path, 0777, true);

	$tmp['login'] = $arr['login'];
	$tmp['passwd'] = hash('whirlpool', $arr['passwd']);
	$account[] = $tmp;
	file_put_contents($file, serialize($account));
}


session_start();
if ($_POST['submit'] == "OK"
	&& $_POST['login'] && $_POST['passwd'])
{
	check_if_user_already_exists($file, $_POST['login']);
	put_data($path, $file, $_POST);
	echo "OK\n";
}
else
	echo "ERROR\n";
?>