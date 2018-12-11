#!/usr/bin/php
<?php
if ($argc == 2)
{
	$nums = array();
	$op = ' ';
	if(is_numeric(strpos($argv[1], '+')))
	{
		$nums = explode("+", $argv[1]);
		$op = '+';
	}
	else if(is_numeric(strpos($argv[1], '-')))
	{
		$nums = explode("-", $argv[1]);
		$op = '-';
	}
	else if(is_numeric(strpos($argv[1], '*')))
	{
		$nums = explode("*", $argv[1]);
		$op = '*';
	}
	else if(is_numeric(strpos($argv[1], '/')))
	{
		$nums = explode("/", $argv[1]);
		$op = '/';
	}
	else if(is_numeric(strpos($argv[1], '%')))
	{
		$nums = explode("%", $argv[1]);
		$op = '%';
	}
	else
	{
		echo ("Syntax Error\n");
		exit(-1);
	}
	$num1 = trim($nums[0]);
	$num2 = trim($nums[1]);

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