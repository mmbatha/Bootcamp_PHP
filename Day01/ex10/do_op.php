#!/usr/bin/php
<?php
if ($argc == 4)
{
	$num1 = trim($argv[1]);
	$op = trim($argv[2]);
	$num2 = trim($argv[3]);
	$res = 0;

	switch ($op)
	{
		case '+':
			echo (($num1 + $num2)."\n");
			break;
		
		case '-':
			echo (($num1 - $num2)."\n");
			break;

		case '*':
			echo (($num1 * $num2)."\n");
			break;

		case '/':
			echo (($num1 / $num2)."\n");
			break;

		default:
			echo (($num1 % $num2)."\n");
			break;
	}
}
else
	echo ("Incorrect Parameters\n");
?>