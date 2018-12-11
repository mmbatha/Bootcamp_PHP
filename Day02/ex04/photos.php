#!/usr/bin/php
<?php
	if ($argc == 2)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $argv[1]);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$exec = curl_exec($ch);

		preg_match_all("<img.+src=\"(.*?)\".+>", $exec, $matches);
		$i = 0;
		$dir = parse_url($argv[1], PHP_URL_HOST);
		if (!is_dir($dir))
		{
			mkdir($dir);
		}
		
		while ($i < count($matches[1]))
		{
			curl_setopt($ch, CURLOPT_URL, $matches[1][$i]);
			$exec = curl_exec($ch);
			$fl = substr($matches[1][$i], strrpos($matches[1][$i], "/") + 1);
			file_put_contents($dir.DIRECTORY_SEPARATOR.$fl, $exec);
			$i++;
		}
		curl_close($ch);
	}
?>