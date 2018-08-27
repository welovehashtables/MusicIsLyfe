<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="$

<!DOCTYPE html>
<html lang="en"><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Music Collab Project</title>

    <!-- Bootstrap core CSS -->
    <link href="../../dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="product.css" rel="stylesheet">
  </head>


  <body>

<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
      <div class="container d-flex flex-column flex-md-row justify-content-between">
        <a class="py-2" href="../index.html" style="font-size:20">Music Collab Project</a>
        <a class="py-2 d-none d-md-inline-block" href="../playsong.html">Listen</a>
<a class="py-2 d-none d-md-inline-block" href="../findmusic.html">Find Music</a>
        <a class="py-2 d-none d-md-inline-block" href="../collaborate.html">Collaborate</a>
        <a class="py-2 d-none d-md-inline-block" href="../insertfile.html">Create Something New</a>
       <a class="py-2 d-none d-md-inline-block" href="../deleteuser.html">Delete User</a>
       <a class="py-2 d-none d-md-inline-block" href="playclip.php">Play Clip</a>

        </div>
    </nav>






  <div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light">
      <div class="col-md-5 p-lg-5 mx-auto my-5">



<?php
	# Variable Instanciation
	$target_dir = "clips/";
	$uname = $_POST["uname"];
	$songname = $_POST["songname"];
	$instrument = $_POST["instrument"];
	$origname = basename($_FILES["myfile"]["name"]);
	$filetype = "." . strtolower(pathinfo($origname, PATHINFO_EXTENSION));


	# Error checking
	if(basename($_FILES["myfile"]["name"]==""))
	{
		exit("Error: No file selected");
	}

	if ($uname == ""){
		exit("Error: No user name defined");
	}

	if ($songname == ""){
		exit("Error: No song name defined");
	}

	if(file_exists($target_file))
	{
		exit("Error: File exists.");
	}


	# Creates a socket to database to check if user exists and max clip id
	$servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "cs411";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
        	die("Connection failed: " . $conn->connect_error);
        }
        echo "Connected successfully<br>";


	# Check if user exists
	$sql = "SELECT userID
		FROM User 
		WHERE Username = '$uname'";
	$result = $conn->query($sql);

	if($result->num_rows == 0)
	{
		exit("Error: User not found.");
	}
	$uid = $result->fetch_assoc()["userID"];
	echo "uid: " . $uid . "<br>";

	
	# Check number of clipid
        $sql = "SELECT max(C.clipID) as max
                FROM Clips C";
        $result = $conn->query($sql);
	$newcid = $result->fetch_assoc()["max"];
	if($newcid==NULL){
		$newcid = 0;
	}
	else {
		$newcid = $newcid + 1;
	}

	echo "newcid: " . $newcid . "<br>";
	$target_file = $target_dir . $newcid . $filetype;


	# Check number of songid
	$sql = "SELECT max(S.songID)as max
		FROM Song S";
	$result = $conn->query($sql);
	$newsongid = $result->fetch_assoc()["max"];
	if($newsongid==NULL){
		$newsongid = 0;
	}
	else{
	$newsongid = $newsongid + 1;
	}
	
	echo "newsongid: " . $newsongid . "<br>";


	# Insert into song
	$sql = "INSERT INTO Song (songID, Title)
		VALUES ('$newsongid', '$songname')";
	if ($conn->query($sql) == TRUE) {
    		echo "New Song created successfully<br>";
	} 
	else {
	    	echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
	}


	# Insert into Collaborates
	$sql = "INSERT INTO Collaborates (userID, songID)
		VALUES ('$uid', '$newsongid')";
	if ($conn->query($sql) == TRUE) {
		echo "New Collaborates created successfully<br>";
	}
	else {
	    	echo "Error: " . $sql . "<br>" . $conn->error . "<br>";		
	}


	# Insert into Clip
	$sql = "INSERT INTO Clips (clipID, MP3clip, ownerID, Instrument)
		VALUES ('$newcid', '$target_file', '$uid', '$instrument')";
	if ($conn->query($sql) == TRUE) {
		echo "New Clip created successfully <br>";
	}	
	else {
		echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
	}


	# Insert into Consists
	$sql = "INSERT INTO Consists (clipID, songID)
		VALUES ('$newcid', '$newsongid')";
	if ($conn->query($sql) == TRUE) {
		echo "New Consists created successfully <br>";
	}	
	else {
		echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
	}



	# Uploads the file
	if(move_uploaded_file($_FILES["myfile"]["tmp_name"], $target_file))
	{
		echo $origname . " uploaded.<br>";
	}
	else
	{
		exit("Error: File cannot upload.");
	}

        $conn->close();

?>
