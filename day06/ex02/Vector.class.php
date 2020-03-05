<?php
class Vector
{
	static public $verbose = false;

	public $_x;
	public $_y;
	public $_z;
	public $_w;

	public function	__construct(array $arr)
	{
		if (!(isset($arr['dest']) && is_a($arr['dest'], 'Vertex')))
			return false;
		
		if (!(isset($arr['orig']) && is_a($arr['orig'], 'Vertex')))
			$arr['orig'] = new Vertex(['x' => 0, 'y' => 0, 'z' => 0]);

		$this->_x = $arr['dest']->x - $arr['orig']->x;
		$this->_y = $arr['dest']->y - $arr['orig']->y;
		$this->_z = $arr['dest']->z - $arr['orig']->z;
		$this->_w = 0;

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
		$str = "x: ".number_format($this->_x, 2, '.', '')//no commas
			.", y: ".number_format($this->_y, 2, '.', '')
			.", z: ".number_format($this->_z, 2, '.', '')
			.", w: ".number_format($this->_w, 2, '.', '');
		return "Vector( ".$str." )";
	}

	public static function doc()
	{
		return file_get_contents('Vector.doc.txt') . PHP_EOL;
	}

	/**************************************
				Math stuff
	**************************************/
	public function	dotProduct(Vector $rhs)
	{
		return (float)(
			($this->_x * $rhs->_x) +
			($this->_y * $rhs->_y) +
			($this->_z * $rhs->_z)
		);
	}

	public function	magnitude()
	{
		return (sqrt($this->dotProduct($this)));
	}

	public function cos(Vector $rhs)
	{
		return ($this->dotProduct($rhs) /
					($this->magnitude() * $rhs->magnitude())
		);
	}

	public function	scalarProduct($k)
	{
		return new Vector([
			'dest' => new Vertex([
					'x' => $this->_x * $k,
					'y' => $this->_y * $k,
					'z' => $this->_z * $k
				])
		]);
	}

	public function	normalize()
	{
		$magnitude = $this->magnitude();
		if ($magnitude > 0)
			return ($this->scalarProduct( 1 / $magnitude));
	}

	public function	opposite()
	{
		return $this->scalarProduct(-1);
	}

	public function	add(Vector $rhs)
	{
		return new Vector([
			'dest' => new Vertex([
					'x' => $this->_x + $rhs->_x,
					'y' => $this->_y + $rhs->_y,
					'z' => $this->_z + $rhs->_z
				])
		]);
	}

	public function	sub(Vector $rhs)
	{
		return new Vector([
			'dest' => new Vertex([
					'x' => $this->_x - $rhs->_x,
					'y' => $this->_y - $rhs->_y,
					'z' => $this->_z - $rhs->_z
				])
		]);
	}
	
	public function crossProduct(Vector $rhs)
	{
		return new Vector([
			'dest' => new Vertex([
					'x' => $this->_y * $rhs->_z - $this->_z * $rhs->_y,
					'y' => $this->_z * $rhs->_x - $this->_x * $rhs->_z,
					'z' => $this->_x * $rhs->_y - $this->_y * $rhs->_x
				])
		]);
	}

}
?>