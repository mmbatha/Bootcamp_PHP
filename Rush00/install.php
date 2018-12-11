<?php
include("../../config.php");

$conn = mysqli_connect($dbhost, $dbuname, $dbpass);

if (!$conn)
	die("Connection failed! ".mysqli_connect_error());
else
{
	echo "Connected successfully!\n";
	$query = mysqli_query($conn, "CREATE DATABASE IF NOT EXISTS $prefix"._."$dbname");
	echo "DB created successfully!\n";
	$conn = mysqli_connect($dbhost, $dbuname, $dbpass, $prefix._.$dbname);

	$sql = "CREATE TABLE IF NOT EXISTS $prefix"._."items
	(
 		id int(100) unsigned NOT NULL AUTO_INCREMENT,
 		login varchar(25) NOT NULL,
 		name varchar(25) NOT NULL,
 		type varchar(50) NOT NULL,
 		colour varchar(10) NOT NULL,
 		price double(6,2) NOT NULL,
 		image varchar(255) NOT NULL,
 		PRIMARY KEY (id),
 		KEY login (login)
	) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;";

	if (mysqli_query($conn, $sql))
		echo "Table $prefix"._."items created successfully!\n";
	else
		echo "Error creating table: ".mysqli_error($conn);
		
	$sql = "CREATE TABLE IF NOT EXISTS $prefix"._."order
	(
		id int(10) unsigned NOT NULL AUTO_INCREMENT,
		login varchar(25) DEFAULT NULL,
		name varchar(25) NOT NULL,
		ordered int(10) NOT NULL,
		price double(6,2) NOT NULL,
		PRIMARY KEY (id),
		KEY login (login),
		UNIQUE (name)
	   ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;";

	if (mysqli_query($conn, $sql))
		echo "Table $prefix"._."order created successfully!\n";
	else
		echo "Error creating table: ".mysqli_error($conn);
	
	$sql = "CREATE TABLE IF NOT EXISTS $prefix"._."users
	(
		id int(10) unsigned NOT NULL AUTO_INCREMENT,
		login varchar(25) NOT NULL,
		email varchar(50) NOT NULL,
		password varchar(500) DEFAULT NULL,
		PRIMARY KEY (id),
		UNIQUE KEY login (login)
	   ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8";

	if (mysqli_query($conn, $sql))
		echo "Table $prefix"._."users created successfully!\n";
	else
		echo "Error creating table: ".mysqli_error($conn);

	$sql = "INSERT INTO $prefix"._."items (login, name, type, colour, price, image) VALUES 
				('admin', 'Oprah', 'Curly', 'Black', 230.00, 'oprah.jpg'), 
				('admin', 'Cara', 'Straight', 'Black', 260.00, 'cara_wigs.jpg'), 
				('admin', 'Roxy', 'Short', 'Black', 200.00, 'roxy_wig.jpg'), 
				('admin', 'Mpho', 'Mix', 'Mixed', 500.00, 'colour_mix.jpg'), 
				('', 'Vanity', 'Lengthy', 'Black', 3500.00, 'vanity_box.jpeg'), 
				('', 'Wavy', 'American', 'Black', 600.00, 'american_wig.jpeg'), 
				('', 'Wendy', 'Brazilian', 'Black', 1200.00, 'brazilian_hair.jpeg'), 
				('', 'Chantal', 'Curly', 'Red', 400.00, 'curly_closure.jpeg'), 
				('', 'Human', 'Wavy', 'Black', 400.00, 'human_hair.jpeg'), 
				('', 'Jerry', 'Curly', 'Black', 500.00, 'jerry_curl.jpeg'), 
				('', 'Kinky', 'Brazilian', 'Black', 1300.00, 'kinky_braz.jpeg'), 
				('', 'Lace', 'Lengthy', 'Black', 2200.00, 'lace_wig.jpeg'), 
				('', 'Laquisha', 'Lengthy', 'Maroon', 1200.00, 'long_wavy.jpeg'), 
				('', 'Toni', 'Lengthy', 'Black', 3500.00, 'middle_part.jpeg'), 
				('', 'Stacy', 'Short', 'Black', 550.00, 'short_weave.jpeg'), 
				('', 'Vivian', 'Straight', 'Black', 1100.00, 'cheap_wigs.jpeg'), 
				('', 'Samantha', 'Lengthy', 'Black', 600.00, 'shoulder_len.jpeg'), 
				('', 'Refiloe', 'Brazilian', 'Black', 1200.00, 'virgin_braz.jpeg'), 
				('', 'Nomathemba', 'Wavy', 'Black', 1200.00, 'wavy_wig.jpeg'), 
				('', 'Samkelisiwe', 'Brazilian', 'Black', 1200.00, 'yaki_braz.jpeg');";

	if (mysqli_query($conn, $sql))
		echo "Data added to $prefix"._."items successfully!\n";
	else
		echo "Error adding data to table: ".mysqli_error($conn);

	$sql = "INSERT INTO $prefix"._."order (login, name, ordered, price) VALUES
				('admin', 'Colour', 1, 500.00),
				('admin', 'Roxy', 1, 200.00),
				('admin', 'Oprah', 1, 230.00),
				('admin', 'Wavy', 0, 600.00),
				('salome', 'Kinky', 1, 1300.00), 
				('salome', 'Refiloe', 1, 1200.00), 
				('salome', 'Samkelisiwe', 1, 1200.00), 
				('salome', 'Wendy', 1, 1200.00), 
				('sshayi', 'Oprah', 1, 230.00), 
				('sshayi', 'Mpho', 1, 500.00), 
				('sshayi', 'Wavy', 1, 600.00);";

	if (mysqli_query($conn, $sql))
		echo "Data added to $prefix"._."order successfully!\n";
	else
		echo "Error adding data to table: ".mysqli_error($conn);
		
	$sql = "INSERT INTO $prefix"._."users (login, email, password) VALUES 
				('admin', 'shortm@live.co.za', '8a0a09f816ef7f03f026de5dfe2774891cc9c96951297f8fa4d1f2e4c3d3eb442a6842bd3222501949464d25c50b0073c9ff360ae40cef8f5a50c2bb2c906939'), 
				('sshayi', 'sshayi@gmail.com', '8a0a09f816ef7f03f026de5dfe2774891cc9c96951297f8fa4d1f2e4c3d3eb442a6842bd3222501949464d25c50b0073c9ff360ae40cef8f5a50c2bb2c906939'), 
				('monray', 'mjacobs@gmail.com', 'cbb37874b47e2f201c50d006964d92cedf8e9168ddaefeaa0a471ff45270451737536c76bb9d621be57cf5fdf089029b0e631f411c2999751a490fad2d7ef7b5'), 
				('simon', 'simon@gmail.com', 'b1a87cbe124750be6b16f836b4787388ab122c48cc10105c7fd139c792c50a197ca802e8c893d724f283ee6850864e807e4eb77786ebf11b1dba6c436cb7e1a6'), 
				('salome', 'salome@gmail.com', '4302af2ca1a92e326f7809dcb7b00bda26850444d5ecf0cdcde2b08921e5fbafde87790fe1b1d328b18df455ae5374ac3d506dbe0bdb3aadf9d899469cbb5644');";

	if (mysqli_query($conn, $sql))
		echo "Data added to $prefix"._."users successfully!\n";
	else
		echo "Error adding data to table: ".mysqli_error($conn);
}
?>