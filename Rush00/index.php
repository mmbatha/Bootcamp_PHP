<?php
	include("../../config.php");
    session_start();
    $order = 0;
    if (!isset($_GET['page']) || $_GET['page'] == "home")
        $page = "app/views/home.html";
    if ($_GET['page'] == "contact")
        $page = "app/views/contact.html";
    if ($_GET['page'] == "login")
        $page = "app/auth/login.php";
    if ($_GET['page'] == "create")
        $page = "app/auth/create.php";
    if ($_GET['page'] == "update")
        $page = "app/auth/update.php";
    if ($_GET['page'] == "logout")
        $page = "app/auth/logout.php";
    if ($_GET['admin'] == "admin")
        header("Location: app/admin/admin.php");
    if ($_GET['page'] == "all" || $_GET['page'] == "curly" || $_GET['page'] == "straight" || $_GET['page'] == "short" || $_GET['page'] == "mix" || $_GET['page'] == "wavy" || $_GET['page'] == "american" || $_GET['page'] == "brazilian" || $_GET['page'] == "lengthy")
        $page = "app/items/items.php";
    if ($_GET['page'] == "cart")
        $page = "app/items/cart.php";
	if (!$_SESSION['logged_on_user'])
	{
        $login = $_SERVER['REMOTE_ADDR'];
        if (strstr($login, "::"))
            $login = trim(str_ireplace("::", " ", $login));
	}
	else
        $login = $_SESSION['logged_on_user'];

	$conn = mysqli_connect($dbhost, $dbuname, $dbpass, $prefix._.$dbname);

	if (mysqli_connect_errno())
	{
		try
		{
			include("install.php");
		}
		catch (mysqli_sql_exception $ex)
		{
            echo("Connect failed: ".mysqli_connect_error());
            exit();
        }

    }

    if ($resLogQueryBask = mysqli_query($conn, "SELECT * FROM $prefix"._."order WHERE login='$login' AND ordered='0'"))
        foreach ($resLogQueryBask as $elem)
           $order++;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="author" content="mmbatha sshayi" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href='img/wig.svg' rel='icon' type='image/svg' />
    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" href="css/site.css">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/contact.css">
    <link rel="stylesheet" href="css/items.css">
    <title>Get Wiggie</title>
</head>
<body>
    <?php include("includes/header.php");?>
    <div class="container">
        <?php include $page; ?>
    </div>
    <footer>
        <hr />
        <p>
            <?php include("includes/footer.php");?> 
        </p>
    </footer>
</body>
</html>