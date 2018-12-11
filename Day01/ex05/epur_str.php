#!/usr/bin/php
<?php
	if ($argc != 2)
		exit();
	$words = preg_replace("/\s+/", " ", $argv[1]);
	$str = trim($words);
	echo ("$str\n");
?>