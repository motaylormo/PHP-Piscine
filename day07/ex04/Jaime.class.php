<?php
class Jaime extends Lannister
{
	public function sleepWith($person)
	{
		if (get_class($person) == "Cersei")
		{
			echo "We are one person in two bodies".PHP_EOL;
			return true;
		}
		parent::sleepWith($person);
	}
}
?>