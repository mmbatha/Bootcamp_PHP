<?php
	class Tyrion 
	{
		public function sleepWith($class)
		{
			if ($class instanceof Jaime)
				print("Not even if I'm drunk !".PHP_EOL);
			else if ($class instanceof Sansa)
				print("Let's do this.".PHP_EOL);
			else if ($class instanceof Cersei)
				print("Not even if I'm drunk !".PHP_EOL);
		}
	}
?>