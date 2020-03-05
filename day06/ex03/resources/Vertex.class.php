<?php
class Vertex
{
	static public $verbose = false;

	public $_x;
	public $_y;
	public $_z;
	public $_w;
//	public $_color;

	public function	__construct(array $arr)
	{
		if (isset($arr['x']) &&
			isset($arr['y']) &&
			isset($arr['z']))
		{
			$this->_x = floatval($arr['x']);
			$this->_y = floatval($arr['y']);
			$this->_z = floatval($arr['z']);
		}
		else
			return false;

		$this->_w = isset($arr['w']) ? floatval($arr['w']) : 1;

//		if (isset($arr['color']) && is_a($arr['color'], 'Color'))
//			$this->_color = $arr['color'];
//		else
//			$this->_color = new Color(['red' => 255, 'green' => 255, 'blue' => 255]);

		if (Self::$verbose)
			echo $this->__toString()." constructed".PHP_EOL;
		return true;
	}

	public function	__destruct()
	{
		if (Self::$verbose)
			echo $this->__toString()." destructed".PHP_EOL;
	}

	public function	__toString()
	{
		$str = "x: ".number_format($this->_x, 2)
			.", y: ".number_format($this->_y, 2)
			.", z:".number_format($this->_z, 2)
			.", w:".number_format($this->_w, 2);
//		if (Self::$verbose)
//			$str = $str.", ".$this->_color->__toString();
		return "Vertex( ".$str." )";
	}

	public static function doc()
	{
		return file_get_contents('Vertex.doc.txt') . PHP_EOL;
	}

	//	https://www.php.net/manual/en/language.oop5.overloading.php#object.get
	public function __get($attr)
	{
		switch ($attr) {
			case 'x':
				return ($this->_x);
			case 'y':
				return ($this->_y);
			case 'z':
				return ($this->_z);
			case 'w':
				return ($this->_w);
//			case 'color':
//				return ($this->_color);
		}
	}

}
?>