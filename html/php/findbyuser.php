<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

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




      	<head>
              	<title>User Info</title>
        </head>

        <body>

              	<?php
                     	$uname = $_POST['inputUname'];
                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $dbname = "cs411";

                        $conn = new mysqli($servername, $username, $password, $dbname);
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                        echo "Connected successfully<br>";

                        $sql = "SELECT Username, Title, songID
                                FROM findByUser
                                WHERE Username ='$uname'";
			
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0){
                        	while($row = $result->fetch_assoc()){
                                	echo "username: " . $row["Username"] . " | title: " . $row["Title"] . " | SongID: " . $row["songID"];
                                	echo "<br>";
                        	}
			}
                        else {  
				echo "0 results";
			}
                        $conn->close();
                ?>

        </body>
	
</html>
