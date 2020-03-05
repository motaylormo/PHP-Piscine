<?php
class UnholyFactory
{
	public	$ranks = array();

	private function print($str)
	{	
		echo "(".$str.")".PHP_EOL;
	}

	public function absorb($fighter)
	{
		if (is_subclass_of($fighter, "Fighter"))
		{
			if (array_key_exists($fighter->name, $this->ranks))
				$this->print("Factory already absorbed a fighter of type ".$fighter->name);
			else
			{
				$this->ranks[$fighter->name] = $fighter;
				$this->print("Factory absorbed a fighter of type ".$fighter->name);
			}
		}
		else
			$this->print("Factory can't absorb this, it's not a fighter");
	}


	public function fabricate($type)
	{
		if (array_key_exists($type, $this->ranks))
		{
			$this->print("Factory fabricates a fighter of type ".$type);
			return (clone $this->ranks[$type]);
		}
		else
			$this->print("Factory hasn't absorbed any fighter of type ".$type);
	}
}
?>