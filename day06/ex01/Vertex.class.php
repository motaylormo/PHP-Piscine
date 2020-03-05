<?php
class Vertex
{
	static public $verbose = false;

	public $x;
	public $y;
	public $z;
	public $w;
	public $color;

	public function	__construct(array $arr)
	{
		if (isset($arr['x']) &&
			isset($arr['y']) &&
			isset($arr['z']))
		{
			$this->x = floatval($arr['x']);
			$this->y = floatval($arr['y']);
			$this->z = floatval($arr['z']);
		}
		else
			return false;

		$this->w = isset($arr['w']) ? floatval($arr['w']) : 1;

		if (isset($arr['color']) && is_a($arr['color'], 'Color'))
			$this->color = $arr['color'];
		else
			$this->color = new Color(['red' => 255, 'green' => 255, 'blue' => 255]);

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
		$str = "x: ".number_format($this->x, 2)
			.", y: ".number_format($this->y, 2)
			.", z:".number_format($this->z, 2)
			.", w:".number_format($this->w, 2);
		if (Self::$verbose)
			$str = $str.", ".$this->color->__toString();
		return "Vertex( ".$str." )";
	}

	public static function doc()
	{
		return file_get_contents('Vertex.doc.txt') . PHP_EOL;
	}

}
?>