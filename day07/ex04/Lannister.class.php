<?php
abstract class Lannister
{
	public $BAC = 0;//Blood alcohol content

	public function sleepWith($person)
	{
		if (get_parent_class($this) === get_parent_class($person))
			echo "Not even if I'm drunk !".PHP_EOL;
		else
			echo "Let's do this.".PHP_EOL;
	}

}
?>