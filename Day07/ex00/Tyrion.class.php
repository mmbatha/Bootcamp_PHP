<?php
	class Tyrion extends Lannister
	{
		public function __construct()
		{
			parent::__construct();
			printf("My name is Tyrion".PHP_EOL);
		}
	
		public function getSize()
		{
			print("Short");
		}
	}
?>