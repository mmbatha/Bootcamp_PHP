<?php
$cookie_name = $_GET["name"];
$cookie_val = $_GET["value"];

	if ($_GET["action"] == "set")
		setcookie($cookie_name, $cookie_val, time() + 3600, "/");
	if ($_GET["action"] == "get")
		echo $_COOKIE[$cookie_name];
	if ($_GET["action"] == "del")
		setcookie($cookie_name, "", time() - 3600);
?>