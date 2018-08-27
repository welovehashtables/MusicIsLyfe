<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "cs411";

	$olduname = $_POST["olduname"];
	$newuname = $_POST["newuname"];

	$conn = new mysqli($servername, $username, $password, $dbname);
	if($conn->connect_error)
	{
		die("Connection failed: " . $conn->connect_error);
	}
	echo "Connected to Server";

	$sql = "SELECT *
		FROM User
		WHERE Username = '$olduname'";
	$result = $conn->query($sql);

	if($result->num_rows==0)
	{
		$conn->close();
		exit("Error: Username nonexistent");
	}
	
	$sql = "UPDATE User
		SET Username = '$newuname'
		WHERE userID = '$result->fetch_assoc()["userID"]'";
	$result = $conn->query($sql);
        if ($result == TRUE) {
        	echo "New Consists created successfully <br>";
        }
	else {
              	echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
        }

?>
