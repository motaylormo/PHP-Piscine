<?php
class Fighter
{
	private $name;

	public function __construct($name)
	{
		$this->name = $name;
	}
	
	public function __get($attr)
	{
		switch ($attr) {
			case 'name':
				return ($this->name);
		}
	}
}
?>