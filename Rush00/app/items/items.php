<?php
	include("../../config.php");
    function refresh($url = NULL) {
        if(empty($url)) {
            $url = $_SERVER['REQUEST_URI'];
        }
        header("Location: ".$url);
        exit();
    }

	$conn = mysqli_connect($dbhost, $dbuname, $dbpass, $prefix._.$dbname);

    if (mysqli_connect_errno()) {
        echo ("Connect failed! ".mysqli_connect_error());
        exit();
    }

    if ($_GET['page'] == "all")
        $sql = mysqli_query($conn, "SELECT * FROM $prefix"._."items");
    if ($_GET['page'] == "curly")
        $sql = mysqli_query($conn, "SELECT * FROM $prefix"._."items WHERE type = 'Curly'");
    if ($_GET['page'] == "straight")
        $sql = mysqli_query($conn, "SELECT * FROM $prefix"._."items WHERE type='Straight'");
    if ($_GET['page'] == "short")
		$sql = mysqli_query($conn, "SELECT * FROM $prefix"._."items WHERE type='Short'");
	if ($_GET['page'] == "mix")
		$sql = mysqli_query($conn, "SELECT * FROM $prefix"._."items WHERE type='Mix'");
	if ($_GET['page'] == "wavy")
		$sql = mysqli_query($conn, "SELECT * FROM $prefix"._."items WHERE type='Wavy'");
	if ($_GET['page'] == "american")
		$sql = mysqli_query($conn, "SELECT * FROM $prefix"._."items WHERE type='American'");
	if ($_GET['page'] == "brazilian")
		$sql = mysqli_query($conn, "SELECT * FROM $prefix"._."items WHERE type='Brazilian'");
	if ($_GET['page'] == "lengthy")
		$sql = mysqli_query($conn, "SELECT * FROM $prefix"._."items WHERE type='Lengthy'");
    echo "<div class='center'>";
    echo "<div class='table'>";
    echo "<table>";
    $i = 0;
    foreach ($sql as $elem) {
            echo "<tr class='responsive'>";
            echo "<td class='t_img'><img src='img/".$elem['image']."' title='".$elem['desc']."' alt='wig'></td>";
            echo "<td class='name' colspan=3>".$elem['name']."";
            echo "<p class='desc'>".$elem['desc']."</p>";
            echo "<p class='price'>R ".$elem['price']."</p>";
            echo "<p><form method='post'><input type='hidden' name='hidden' value='$i'><input type='submit' name='submit' value='Buy'></form></p></td>";
            echo "</tr>";
            $i++;
    }
    echo "</table>";
    echo "</div>";
    echo "</div>";

    if (isset($_POST['submit'])) {
        if ($_POST['submit'] == "Buy") {
            $i = (int)$_POST['hidden'];
            $find = 0;

            if (!$_SESSION['logged_on_user']) {
                $login = $_SERVER['REMOTE_ADDR'];
                if (strstr($login, "::")) {
                    $login = trim(str_ireplace("::", " ", $login));
                }
            } else {
                $login = $_SESSION['logged_on_user'];
            }

            $ordered = 0;

            foreach ($sql as $elem) {
                if ($find == $i) {
                    $name = $elem['name'];
					$price = $elem['price'];
					$sql = "INSERT INTO $prefix"._."order (login, name, ordered, price) VALUES ('$login', '$name', '$ordered', '$price')";
					if (mysqli_query($conn, $sql)) {
						echo "Added to your order!";
					} else {
						echo "Error: ".$sql."<br>".mysqli_error($conn);
					}
                    break ;
                }
                $find++;
            }
            refresh();
        }
    }