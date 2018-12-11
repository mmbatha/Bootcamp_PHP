#!/usr/bin/php
<?php
	function ft_split($str)
	{
		$words = explode(" ", $str);
		$sorted_words = array_values(array_filter($words));
		sort($sorted_words);
		return ($sorted_words);
	}

	if ($argc > 1)
	{
		$myArray = array();
		for ($i = 1; $i < count($argv); $i++)
		{ 
			$str = trim(preg_replace("/\s+/", " ", $argv[$i]));
			$splitstr = ft_split($str);
			for ($j = 0; $j < count($splitstr); $j++)
				$word = array_push($myArray, $splitstr[$j]);
		}
		sort($myArray);
		for ($k = 0; $k < count($myArray); $k++)
			echo ($myArray[$k]."\n");
	}
?>