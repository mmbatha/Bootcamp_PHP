<?php
	include("../../config.php");
    if (isset($_POST['submit'])) {
        if ($_POST['submit'] === "Sign In") {
			$conn = mysqli_connect($dbhost, $dbuname, $dbpass, $prefix._.$dbname);

            if (mysqli_connect_errno()) {
                echo ("Connect failed! ".mysqli_connect_error());
                exit();
            }

            $login = $_POST['login'];
            $email = $_POST['email'];
            $passwd = hash('whirlpool', $_POST['passwd']);

			$flag = 1;
			$sql = "SELECT * FROM $prefix"._."users";
			$result = mysqli_query($conn, $sql);
			if (mysqli_num_rows($result) > 0) {
				while ($row = mysqli_fetch_assoc($result))
				{
					if ($row['login'] == $login)
					{
                   		echo "Login is already in use!";
                    	$flag = 0;
                	}
            	}
			}
            if ($flag == 1) {
				$sql = "INSERT INTO $prefix"._."users (login, email, password) VALUES ('$login', '$email', '$passwd')";
				if (mysqli_query($conn, $sql))
				{
					echo "Data added to $prefix"._."users successfully!\n";
                	$_SESSION['logged_on_user'] = $login;
					header("Location: index.php");
				}
				else
					echo "Error adding data to table: ".mysqli_error($conn);
            }
        }
    }
?>
<div class="form">
    <form method="POST" action="">
        <fieldset>
            <legend>Create account</legend>
            <input type="text" name="login" placeholder="Login" value="" />
            <input type="email" name="email" placeholder="E-mail" value="" />
            <input type="password" name="passwd" placeholder="Password" value="" />
            <input type="password" name="conf_passwd" placeholder="Confirm Password" value="" />
        </fieldset>
        <input type="submit" name="submit" value="Sign In" />
    </form>
</div>