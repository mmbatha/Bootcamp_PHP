<?php
	include("../../config.php");
    if (isset($_POST['submit'])) {
        if ($_POST['submit'] == "Update") {
			$conn = mysqli_connect($dbhost, $dbuname, $dbpass, $prefix._.$dbname);

            if (mysqli_connect_errno()) {
                echo ("Connect failed! ".mysqli_connect_error());
                exit();
            }

            $login = $_POST['login'];
            $passwd = hash("whirlpool", $_POST['old_passwd']);
            $new_passwd = hash("whirlpool", $_POST['new_passwd']);

            $resLogQuery = mysqli_query($conn, "SELECT * FROM $prefix"._."users WHERE login = '$login'");
            $row = mysqli_fetch_array($resLogQuery);

            if ($row) {
                if ($row['password'] == $passwd) {
                    $query = mysqli_query($conn, "UPDATE $prefix"._."users SET password = '$new_passwd' WHERE login = '$login'");
                    echo "<h3 style='color: green'>Update has been successful</h3>";
                } else {
                    echo "<h3 style='color: red'>Wrong password</h3>";
                }
            } else {
                echo "<h3 style='color: red'>Wrong login</h3>";
            }
        }
    }

    if (isset($_POST['delete'])) {
        if ($_POST['delete'] == "Delete Account") {
            $conn = mysqli_connect($dbhost, $dbuname, $dbpass, $prefix._.$dbname);

            if (mysqli_connect_errno()) {
                echo ("Connect failed! ".mysqli_connect_error());
                exit();
            }

            $login = $_POST['login'];
            $passwd = hash("whirlpool", $_POST['old_passwd']);

            $resLogQuery = mysqli_query($conn, "SELECT * FROM $prefix"._."users WHERE login = '$login'");
            $row = mysqli_fetch_array($resLogQuery);

            if ($row) {
                if ($row['password'] === $passwd) {
                    $query = mysqli_query($conn, "DELETE FROM $prefix"._."users WHERE login = '$login'");
                    $_SESSION['logged_on_user'] = "";
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
            <legend>Update account</legend>
            <input type="text" name="login" placeholder="Login" /><br />
            <input type="password" name="old_passwd" placeholder="Old Password" /><br />
            <input type="password" name="new_passwd" placeholder="New Password" />
        </fieldset>
        <input type="submit" name="submit" value="Update" />
        <input type="submit" name="delete" value="Delete Account" />
    </form>
</div>