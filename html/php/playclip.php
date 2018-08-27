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
        <h1 class="display-4 font-weight-normal">Play a Clip: </h1>
        
        <br>



    <form id="playbackclip"  method="post" action="?action">
           

    <p>            Clip id:<br></p>
        <input id="clipid" name="clipid" type="text">
        <br><br>
        <input type="submit" value="Submit" id="submit" />
    </form>






<?php
if(isset($_GET['action'])){
        $cid = $_POST["clipid"];
#                echo $cid;
                if ($cid == ""){
                        exit("Error: No clip id defined");}

$servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "cs411";
	$clipurl = "";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
        }
#            echo "Connected successfully<br>";

        # Check number of clipid
        $sql = "SELECT C.clipID
                FROM Clips C
        WHERE clipID = '$cid' ";

        $result = $conn->query($sql);

        if($result->num_rows < 1){
	        exit ('clip not found');}
	else{
		echo $cid;
		$clipurl = "clips/" . $cid . ".mp3";
	}

}
$conn->close();
?>





<br><br>

    
<audio controls>

  <source src="<?=$clipurl?>" type="audio/mpeg">
Your browser does not support the audio element.
</audio>

    
    
    </div>
      <div class="product-device box-shadow d-none d-md-block"></div>
      <div class="product-device product-device-2 box-shadow d-none d-md-block"></div>
    </div>
    
    
    
    
    
    
    
  <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../../assets/js/vendor/popper.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <script src="../../assets/js/vendor/holder.min.js"></script>
    <script>
      Holder.addTheme('thumb', {
        bg: '#55595c',
        fg: '#eceeef',
        text: 'Thumbnail'
      });
    </script>
  

</body>
</html>

