#!/usr/bin/php
<?php
	function ft_is_sort($argv)
	{
		if (count($argv) == 1)
			return (TRUE);
		$temp = $argv;
		sort($temp);
		for ($i = 0; $i < count($temp); $i++)
		{ 
			if (strcmp($temp[$i], $argv[$i]))
				return (FALSE);
		}
		return (TRUE);
	}
?>