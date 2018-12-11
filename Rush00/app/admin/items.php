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

    $sql = mysqli_query($conn, "SELECT * FROM $prefix"._."items");

    if (($row = mysqli_fetch_array($sql))  == NULL) {
        echo "<h2 style='color: #E6855F'>No items</h2>";
    }

    foreach ($sql as $elem) {
        echo "<form action='' method='post'>";
        $i = 0;
        foreach ($elem as $value) {
            if ($value == $elem['img']) {
                echo "<img src='$value' alt='apple' width='100' height='100'>";
            } else {
                echo "<input type='text' name='$i' value='$value'>";
            }
            $id = $elem['id'];
            $i++;
        }
        echo "<input type='hidden' name='value_id' value='{$id}'>";
        echo "<input type='submit' name='delete' value='Delete'>";
        echo "<input type='submit' name='update_item' value='Edit'>";
        echo "<hr style='height: 5px'>";
        echo "</form>";
    }

    if (isset($_POST['delete'])) {
        if ($_POST['delete'] == "Delete") {
            $id = $_POST['value_id'];

            $query = mysqli_query($conn, "DELETE FROM $prefix"._."items WHERE id = '$id'");
            refresh();
        }
    }

    if (isset($_POST['update_item'])) {
        if ($_POST['update_item'] == "Edit") {
			$id = $_POST['value_id'];
            $name = $_POST['1'];
            $type = $_POST['2'];
            $desc = $_POST['3'];
            $price = $_POST['4'];

            $query = mysqli_query($conn, "UPDATE $prefix"._."items SET name = '$name', type = '$type', desc = '$desc', price = '$price' WHERE id = '$id'");
            refresh();
        }
    }