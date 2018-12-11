#!/usr/bin/php
<?php
	if ($argc > 1)
	{
		for ($i = 0; $i < $argc; $i++)
		{ 
			$str = trim(preg_replace("/\s+/", " ", $argv[1]));
			$words = explode(" ", $str);
		}
		for ($j = 1; $j < count($words); $j++)
			echo ($words[$j]." ");
		echo ($words[0]."\n");
	}
?>
