<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Page Title</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<header>
        <nav>
            <ul class="topmenu">
                <li><a href="index.php?page=home">Home</a></li>
                <?php
                    if ($_SESSION['logged_on_user'] == "") {
                        echo "<li><a href=\"index.php?page=login\">Login</a></li>";
                    } else {
                        echo "<li><a href=\"index.php?page=update\">".$_SESSION['logged_on_user']."</a></li>";
                        echo "<li><a href=\"index.php?page=logout\">Log Out</a></li>";
                    }
                ?>
                <li><a href="index.php?page=all" class="down">Products</a>
                    <ul class="submenu down_down">
                        <li><a href="index.php?page=all">All</a></li>
                        <li><a href="index.php?page=american">American</a></li>
                        <li><a href="index.php?page=brazilian">Brazilian</a></li>
                        <li><a href="index.php?page=curly">Curly</a>
                        <li><a href="index.php?page=lengthy">Lengthy</a></li>
						<li><a href="index.php?page=mix">Mix</a></li>
                        <li><a href="index.php?page=short">Short</a></li>
						<li><a href="index.php?page=straight">Straight</a></li>
                        <li><a href="index.php?page=wavy">Wavy</a></li>
                    </ul>
                </li>
                <li><a href="index.php?page=cart">Cart<?php if ($order) {echo "(".$order.")";}?></a></li>
                <li><a href="index.php?page=contact">Contact</a></li>
            </ul>
        </nav>
    </header>
</body>
</html>