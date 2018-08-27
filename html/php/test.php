<!DOCTYPE html>
<html>
	<body>

		<p id="debug">Debugging</p>

		<form method="post">
			Song ID: <input type="text" name="songid">
			<input type="submit" name="submit">
		</form>

		<!-- Buttons -->
		<button onclick="displayAudio()">Display</button>
		<button onclick="playAudio()">Play</button>
		<button onclick="pauseAudio()">Pause</button>

		
		<!-- PHP -->
		<?php
		if(isset($_POST["submit"])){
			$sid = $_POST["songid"];
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "cs411";
			$clips = array();

			if($sid == ""){
				exit("Error: No song id defined");
			}

			$conn = new mysqli($servername, $username, $password, $dbname);
			if($conn->connect_error){
				die("Connection failed: " . $conn->connect_error);
			}

			$sql = "SELECT clipID
				FROM Consists
				WHERE songID = '$sid'";
			$result = $conn->query($sql);

			if($result->num_rows > 0){
				while($row = $result->fetch_assoc()){
					$new_clip = "clips/" . $row["clipID"] . ".mp3";
					# echo $new_clip . "<br>";
					array_push($clips, $new_clip);
				}
			}
			else{
				echo "0 results<br>";
			}
			$conn->close();
		}
		?>


		<!-- Javascript -->
		<script>		

		var clip_name;
		var clip_array = [];

		function displayAudio(){
			if(clip_array.length==0){
				clip_name = <?php echo json_encode($clips)?>;
				clip_array = [];
				for(var i = 0; i < clip_name.length; i++){
					clip_array.push(new Audio(clip_name[i]));
				}			
			}

			document.getElementById("debug").innerHTML = clip_array.length;
		}

		function playAudio(){
			if(clip_array.length==0){
				clip_name = <?php echo json_encode($clips)?>;
				clip_array = [];
				for(var i = 0; i < clip_name.length; i++){
					clip_array.push(new Audio(clip_name[i]));
				}			
			}

			for(var i = 0; i < clip_array.length; i++){
				if(!clip_array[i].paused){
					clip_array[i].currentTime = 0; 
				}
				clip_array[i].play();
			}

		}

		function pauseAudio(){
			for(var i = 0; i < clip_array.length; i++){
				clip_array[i].pause();
			}
		}


		</script>
	</body>
</html>
