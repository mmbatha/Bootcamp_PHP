#!/usr/bin/php
<?php
	function ft_is_sort($arr)
	{
		if (ctype_alpha($i[0]) && ctype_alpha($j[1]))
			$ret = (strcasecmp($i, $j));
		if (ctype_digit($i[0]) && ctype_digit($j[0]))
			$ret = ($i > $j ? 1 : ($i == $j ? 0 : -1));
		return ($ret < 0 ? 1 : ($ret == 0 ? 0 : -1));
	}
	$result = array();
	for ($i = 1; $i < $argc; $i++)
	{ 
		$array = $argv[$i];
		$array = preg_replace('/\s\s+/', ' ', $array);
		$array = explode(" ", $array);
		$result = array_merge($result, $array);
	}
	sort($result, SORT_STRING | SORT_FLAG_CASE);
	$i = 0;
	$nums = array();
	foreach ($result as $num)
	{
		if (is_numeric($num))
			$nums[$i++] = $num;
	}
	$result = array_diff($result, $nums);
	$i = 0;
	$spec = array();
	foreach ($result as $word)
	{
		$char = ord($word);
		if (($char > 31 && $char < 48) || ($char > 57 && $char < 65) ||
			($char > 90 && $char < 97) || ($char > 122 && $char < 127))
			$spec[$i++] = $word;
	}
	$result = array_diff($result, $spec);
	foreach ($result as $word)
		print($word."\n");
	foreach ($nums as $word)
		print($word."\n");
	foreach ($spec as $word)
		print($word."\n");
?>