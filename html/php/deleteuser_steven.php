<!DOCTYPE html>
<html>
	<body>
		<?php
			$uname = $_POST['uname'];
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "cs411";

			# Sees if username is blank
			if ($uname == ""){
				exit("Error: User id not defined");
			}

			# Creates a connection to the database
			$conn =  new mysqli($servername, $username, $password, $dbname);
			if ($conn->connect_error){
				die("Connection failed: " . $conn->connect_error);
			}

			# Check if username exists
			$sql = "SELECT *
				FROM User
				WHERE Username = '$uname'";
			$result = $conn->query($sql);

			if($result->num_rows < 1){
				exit("Error: User id does not exist");
			}

			# Find all clips associated with the username
			$sql = "SELECT clipID
				FROM Clips
				WHERE ownerID = '$uname'";
			$clip_list = $conn->query($sql);

			# Delete all entities from Clips with ownerID = $uname
			$sql = "DELETE FROM Clips
				WHERE ownerID = '$uname'";
			$conn->query($sql);

			# Delete all entities from Collaborates with userID = $uname
			$sql = "DELETE FROM Collaborates
				WHERE userID = '$uname'";
			$conn->query($sql);

			# Delete all entities from Consists with clipID = $clip_list
			$sql = "DELETE FROM Consists
				WHERE clipID = '$clip_list'";			

			# .... deletes from triggers

			while($row = $clip_list->fetch_assoc()){
				$target_file = "clips/" . $row["clipID"] . ".mp3";
				unlink($target_file);
			}

			$conn->close();

		?>
	</body>
</html>
