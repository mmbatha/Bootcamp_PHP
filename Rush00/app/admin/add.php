<?php
include("../../config.php");
if (isset($_POST['add'])) {
	if ($_POST['add'] == "ADD") {
		print_r($_POST);
		exit();
		$name = $_POST['name'];
		$type = $_POST['type'];
		$desc = $_POST['desc'];
		$price = (int)$_POST['price'];
		$image = $_POST['image'];

		$conn = mysqli_connect($dbhost, $dbuname, $dbpass, $prefix._.$dbname);

		if (mysqli_connect_errno()) {
			echo("Connect failed: ".mysqli_connect_error());
			exit();
		}

		$queryInsert = mysqli_query($conn, "INSERT INTO $prefix"._."items (name, type, desc, price, image) VALUES ('$name', '$type', '$desc', '$price', '$image')");

	}
}
?>
<form method="post" action="">
<input type="text" name="name" value="" placeholder="name" /><br>
<input type="text" name="type" value="" placeholder="type" /><br>
<input type="text" name="desc" value="" placeholder="desc" /><br>
<input type="text" name="price" value="" placeholder="price" /><br>
<input type="text" name="image" value="" placeholder="image" /><br>
<input type="submit" name="add" value="ADD" />
</form>