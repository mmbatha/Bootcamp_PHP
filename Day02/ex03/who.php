#!/usr/bin/php
<?php
	$file = fopen("/var/run/utmpx", "rb");
	fseek($file, 1256);
	date_default_timezone_set("Africa/Johannesburg");
	while (!feof($file))
	{
		$fdata = fread($file, 628);
		if (strlen($fdata) == 628)
		{
			$fdata = unpack("a256user/a4id/a32line/ipid/itype/itime", $fdata);
			if ($fdata['type'] == 7)
			{
				echo trim($fdata['user'])."  ";
				echo trim($fdata['line'])."  ";
				$time = date("M  j H:i", $fdata['time']);
				echo $time." \n";
			}
		}
	}
?>