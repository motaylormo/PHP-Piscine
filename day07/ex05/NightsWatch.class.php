<?php
class NightsWatch implements IFighter
{
	public	$brothers = array();

	public function	recruit($person)
	{
		$this->brothers[] = $person;
	}

	public function	fight()
	{
		foreach ($this->brothers as &$bro) {
			if (method_exists(get_class($bro), "fight"))
				$bro->fight();
		}
	}
}
?>