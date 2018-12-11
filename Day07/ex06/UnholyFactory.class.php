<?php
class UnholyFactory
{
	private $_soldiers = array();

	public function absorb($man)
	{
		if (get_parent_class($man))
		{
			if (isset($this->_soldiers[$man->getType()]))
				print("(Factory already absorbed a fighter of type ".$man->getType().")".PHP_EOL);
			else
			{
				print("(Factory absorbed a fighter of type ".$man->getType().")".PHP_EOL);
				$this->_soldiers[$man->getType()] = $man;
			}
		}
		else
			print("(Factory can't absorb this, it's not a fighter)".PHP_EOL);
	}

	public function fabricate($man)
	{
		if (array_key_exists($man, $this->_soldiers))
		{
			print("(Factory fabricates a fighter of type ".$man.")".PHP_EOL);
			return (clone $this->_soldiers[$man]);
		}
		print("(Factory hasn't absorbed any fighter of type ".$man.")".PHP_EOL);
		return NULL;
	}
}
?>