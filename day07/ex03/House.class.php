<?php
//	https://www.php.net/manual/en/language.oop5.abstract.php
abstract class House
{
	abstract public function getHouseName();
	abstract public function getHouseSeat();

	public function introduce()
	{
		echo "House ".$this->getHouseName()." of ".$this->getHouseSeat()." :";
		//	A house could have a name and seat, but no motto (aka the Freys)
		if (method_exists(get_called_class(), "getHouseMotto"))
			echo " \"".$this->getHouseMotto()."\"";
		echo PHP_EOL;
	}
}
?>