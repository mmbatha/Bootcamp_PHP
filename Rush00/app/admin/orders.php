<?php
	include("../../config.php");
    function refresh($url = NULL) {
        if (empty($url)) {
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

    $sql = mysqli_query($conn, "SELECT * FROM $prefix"._."order");

    if (($row = mysqli_fetch_array($sql)) == NULL) {
        echo "<h2 style='color: #E6855F'>No orders</h2>";
    }

    foreach ($sql as $elem) {
        echo "<form action='' method='post'>";
        $i = 0;
        foreach ($elem as $value) {
            echo "<input type='text' name='$i' value='$value'>";
            $i++;
        }
        echo "<input type='submit' name='delete' value='Delete'>";
        echo "</form>";
    }

    if (isset($_POST['delete'])) {
        if ($_POST['delete'] == "Delete") {
            $id = $_POST[0];

            $resLogQuery = mysqli_query($conn, "SELECT * FROM $prefix"._."order WHERE id = '$id'");

            if ($resLogQuery) {
                $sql = mysqli_query($conn, "DELETE FROM $prefix"._."order WHERE id = '$id'");
                refresh();
            }
        }
    }