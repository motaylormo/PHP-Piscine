<?php
class Targaryen
{
	public function resistsFire()
	{
		return false;
	}

	public function getBurned()
	{
		return ($this->resistsFire() ? "emerges naked but unharmed" : "burns alive");
	}
}
?>