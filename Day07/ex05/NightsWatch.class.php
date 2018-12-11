<?php
class NightsWatch implements IFighter
{
	private $_soldiers = array();

	public function recruit($man)
	{
		$this->_soldiers[] = $man;
	}

	public function fight()
	{
		foreach ($this->_soldiers as $soldier)
		{
			if (method_exists(get_class($soldier), 'fight'))
				$soldier->fight();
		}
	}
}
?>