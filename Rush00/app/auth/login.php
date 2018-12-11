<?php
	include("../../config.php");
    if (isset($_POST['submit'])) {
        if ($_POST['submit'] == "Sign In") {
			$conn = mysqli_connect($dbhost, $dbuname, $dbpass, $prefix._.$dbname);

            if (mysqli_connect_errno()) {
                echo ("Connect failed! ".mysqli_connect_error());
                exit();
            }

            $login = $_POST['login'];
            $passwd = hash("whirlpool", $_POST['passwd']);
            $resLogQuery = mysqli_query($conn, "SELECT * FROM $prefix"._."users WHERE login = '$login'");

            $row = mysqli_fetch_array($resLogQuery);

            if ($row) {
                if ($row['password'] == $passwd) {
                    $_SESSION['logged_on_user'] = $login;
                    header("location: index.php");
                } else {
                    echo "<h3 style='color: red'>Wrong password</h3>";
                }
            } else {
                echo "<h3 style='color: red'>Wrong login</h3>";
            }
        }
    }
?>
<div class="form">
    <form method="POST" action="">
        <fieldset>
            <legend>Login</legend>
            <input type="text" name="login" placeholder="Login" value="" /><br />
            <input type="password" name="passwd" placeholder="Password" value="" />
        </fieldset>
        <input type="submit" name="submit" value="Sign In" />
    </form>
    <a href="index.php?page=create">Create account</a>
    <a href="index.php?page=update">Update account</a>
 </div>