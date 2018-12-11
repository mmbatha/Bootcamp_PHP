<?php
	include("../../config.php");
    session_start();
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

    if (!$_SESSION['logged_on_user']) {
        $login = $_SERVER['REMOTE_ADDR'];
        if (strstr($login, "::")) {
            $login = trim(str_ireplace("::", " ", $login));
        }
    } else {
        $login = $_SESSION['logged_on_user'];
    }

    $resLogQuery = mysqli_query($conn, "SELECT * FROM $prefix"._."order WHERE login='$login' AND ordered='0'");

    echo "<div class='center'>";
    echo "<div class='table'>";
    echo "<table><br>";
    $i = 0;
    $total = 0;
    foreach ($resLogQuery as $elem) {
        echo "<tr>";
        echo "<td style='color: #d3731a; height: 70px; font-weight: bold'>".$elem['name'] . "</td>";
        echo "<td style='color: #d3731a; height: 70px;'>R ".$elem['price']."</td>";
        echo "<td><form method='post'><input type='hidden' name='hidden' value='$i'><input style='padding: 10px; margin-top: 10px;' type='submit' name='submit' value='Delete'></form></td>";
        echo "</tr>";
        $total = $total + $elem['price'];
        $i++;
    }
    echo "<tr><td style='color: #d3731a; height: 70px; font-weight: bold'>Total: </td><td style='color: #d3731a; height: 70px;'>R $total</td><td><form method='post'><input style='padding: 10px; margin-top: 10px;' type='submit' name='order' value='Order'></form></td></tr>";
    echo "</table>";
    echo "</div>";
    echo "</div>";

    if (isset($_POST['submit'])) {
        if ($_POST['submit'] == "Delete") {
            $i = (int)$_POST['hidden'];
            $find = 0;

            foreach ($resLogQuery as $elem) {
                if ($find == $i) {
                    $id = $elem['id'];
                    mysqli_query($conn, "DELETE FROM $prefix"._."order WHERE id = '$id'");
                    refresh();
                }
                $find++;
            }
        }
    }

    if (isset($_POST['order'])) {
        if ($_POST['order'] == 'Order' && $total > 0) {
            if (!$_SESSION['logged_on_user']) {
                header("location: index.php?page=login");
            } else {
                mysqli_query($conn, "UPDATE $prefix"._."order SET ordered = '1' WHERE login='$login' AND ordered='0'");
                echo "<div><h2 style='color: #d3731a'>Your order has been processed.</h2></div>";
            }
        }
    }