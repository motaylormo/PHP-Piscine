<?php
class Color
{
	public $red;
	public $green;
	public $blue;

	static public $verbose = false;

	public function	__construct(array $arr)
	{
		if (isset($arr['red']) &&
			isset($arr['green']) &&
			isset($arr['blue']))
		{
			$this->red = intval(	$arr['red']);
			$this->green = intval(	$arr['green']);
			$this->blue = intval(	$arr['blue']);
		}
		else if (isset($arr['rgb']))
		{
			$this->red = intval(	($arr['rgb'] >> 16) & 0xFF);
			$this->green = intval(	($arr['rgb'] >> 8) & 0xFF);
			$this->blue = intval(	$arr['rgb'] & 0xFF);
		}
		else
			return false;

//	$options = array(
//		'options' => array(
//			'default' => 0,// value to return if the filter fails
//			'min_range' => 0,
//			'max_range' => 255
//		)
//	);
//	$this->red = filter_var($arr['red'], FILTER_VALIDATE_INT, $options);

		if (Self::$verbose)
			echo $this->__toString()." constructed.".PHP_EOL;
		return true;
	}

	public function	__destruct()
	{
		if (Self::$verbose)
			echo $this->__toString()." destructed.".PHP_EOL;
	}

	public function	__toString()
	{
		return "Color( "
					."red: ".str_pad($this->red, 3, ' ', STR_PAD_LEFT).", "
					."green: ".str_pad($this->green, 3, ' ', STR_PAD_LEFT).", "
					."blue: ".str_pad($this->blue, 3, ' ', STR_PAD_LEFT)
				." )";
	}

	public static function doc()
	{
		return file_get_contents('Color.doc.txt') . PHP_EOL;
	}

	/*
		The Class must have a method called ___
		that allows you to ___ the the components of the current instance
		to the components of another instance argument.
		The resulting color is a new instance.
	*/
	public function	add($Color)
	{
		return (new Color(
			array('red' => $this->red + $Color->red,
				'green' => $this->green + $Color->green,
				'blue' => $this->blue + $Color->blue)
		));
	}

	public function	sub($Color)
	{
		return (new Color(
			array('red' => $this->red - $Color->red,
				'green' => $this->green - $Color->green,
				'blue' => $this->blue - $Color->blue)
		));
	}
	
	public function	mult($num)
	{
		return (new Color(
			array('red' => $this->red * $num,
				'green' => $this->green * $num,
				'blue' => $this->blue * $num)
		));
	}

}
?>