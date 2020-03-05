<?php
class Matrix
{
	static public $verbose = false;

	protected $_matrix;

	const IDENTITY = "IDENTITY";
	const SCALE = "SCALE";
	const RX = "Ox ROTATION";
	const RY = "Oy ROTATION";
	const RZ = "Oz ROTATION";
	const TRANSLATION = "TRANSLATION";
	const PROJECTION = "PROJECTION";

	public function	__construct(array $arr)
	{
		if (!isset($arr['preset']))
			return false;

		$this->initMatrix();

		switch ($arr['preset'])
		{
			case (self::IDENTITY):
				$this->identity();
				break;
			case (self::SCALE):
				if (isset($arr['scale']))
				{
					$this->identity();
					$this->scale($arr['scale']);
				}
				break;
		}

		if (isset($arr['angle']))
		{
			switch ($arr['preset'])
			{
				case (self::RX):
					$this->rotateX($arr['angle']);
					break;
				case (self::RY):
					$this->rotateY($arr['angle']);
					break;
				case (self::RZ):
					$this->rotateZ($arr['angle']);
					break;
			}
		}


		switch ($arr['preset'])
		{
			case (self::TRANSLATION):
				if (isset($arr['vtc']))
					$this->translate($arr['vtc']);
				break;

			case (self::PROJECTION):
				if (isset($arr['fov']) && isset($arr['ratio']) &&
					isset($arr['near']) && isset($arr['far']))
				{
					$this->project($arr['fov'], $arr['ratio'], $arr['near'], $arr['far']);
				}
				break;
		}

		if (Self::$verbose)
			echo "Matrix ".$arr['preset']
				.(($arr['preset'] == Self::IDENTITY) ? "" : " preset")
				." instance constructed".PHP_EOL;
		return true;
	}

	private function	initMatrix()
	{
		for ($i = 0; $i < 4; $i++)
		{
			for ($j = 0; $j < 4; $j++)
				$this->_matrix[$i][$j] = 0;
		}
	}

	public function	__destruct()
	{
		if (Self::$verbose)
			echo "Matrix instance destructed".PHP_EOL;
	}

	public function	__toString()
	{
		$row = ['x', 'y', 'z', 'w'];
		$str = "M | vtcX | vtcY | vtcZ | vtxO".PHP_EOL
				."-----------------------------".PHP_EOL;
		for ($i = 0; $i < 4; $i++)
		{
			$str .= $row[$i];
			for ($j = 0; $j < 4; $j++)
				$str .= " | ".number_format($this->_matrix[$i][$j], 2);
			$str .= PHP_EOL;
		}
		return $str;
	}

	public static function	doc()
	{
		return file_get_contents('Matrix.doc.txt').PHP_EOL;
	}

	/**************************************
				Math stuff
	**************************************/
	private	function	identity()
	{
		for ($i = 0; $i < 4; $i++)
		{ 
			$this->_matrix[$i][$i] = 1;
		}
	}

	private function	scale($scale)
	{
		for ($i = 0; $i < 3; $i++)
		{
			for ($j = 0; $j < 3; $j++)
				$this->_matrix[$i][$j] *= $scale;
		}
	}

//	https://en.wikipedia.org/wiki/Rotation_matrix#Basic_rotations
	private function	rotateX(float $angle)
	{
		$this->identity();
		$this->_matrix[1][1] = cos($angle);
		$this->_matrix[1][2] = -sin($angle);
		$this->_matrix[2][1] = sin($angle);
		$this->_matrix[2][2] = cos($angle);
	}

	private function	rotateY(float $angle)
	{
		$this->identity();
		$this->_matrix[0][0] = cos($angle);
		$this->_matrix[0][2] = sin($angle);
		$this->_matrix[2][0] = -sin($angle);
		$this->_matrix[2][2] = cos($angle);
	}

	private function	rotateZ(float $angle)
	{
		$this->identity();
		$this->_matrix[0][0] = cos($angle);
		$this->_matrix[0][1] = -sin($angle);
		$this->_matrix[1][0] = sin($angle);
		$this->_matrix[1][1] = cos($angle);
	}

//	https://en.wikipedia.org/wiki/Translation_(geometry)#Matrix_representation
	private function	translate(Vector $vtc)
	{
		$this->identity();
		$this->_matrix[0][3] = $vtc->x;
		$this->_matrix[1][3] = $vtc->y;
		$this->_matrix[2][3] = $vtc->z;
	}


//	https://gamedev.stackexchange.com/questions/120338/what-does-a-perspective-projection-matrix-look-like-in-opengl
	private function	project($fov, $ratio, $near, $far)
	{
		$this->_matrix[0][0] = 1 / ($ratio * tan(deg2rad($fov) / 2));
		$this->_matrix[1][1] = 1 / tan(deg2rad($fov) / 2);
		$this->_matrix[2][2] = -1 * ($far + $near) / ($far - $near);
		$this->_matrix[2][3] = -1 * (2 * $far * $near) / ($far - $near);
		$this->_matrix[3][2] = -1;
	}

	/**************************************
		methods
	**************************************/
	public function	mult(Matrix $rhs)
	{
		$tmp = array();
		for ($i = 0; $i < 4; $i++)
		{
			for ($j = 0; $j < 4; $j++)
			{
				$tmp[$i][$j] = 0;
				for ($k = 0; $k < 4; $k++)
					$tmp[$i][$j] += $this->_matrix[$i][$k] * $rhs->_matrix[$k][$j];
			}
		}
		$matrice = new Matrix(['preset' => '']);
		$matrice->_matrix = $tmp;
		return $matrice;
	}

	public function	transformVertex(Vertex $vtx)
	{
		$tmp = array();
		$row = ['x', 'y', 'z', 'w'];
		for ($i = 0; $i < 4; $i++)
		{
			$tmp[$row[$i]] = 0;
			for ($j = 0; $j < 4; $j++)
			{
				$key = $row[$j];
				$tmp[$row[$i]] += $vtx->$key * $this->_matrix[$i][$j];
			}
		}
		return (new Vertex($tmp));
	}

}
?>