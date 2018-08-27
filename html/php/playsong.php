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
      <div class="col-md-10 p-lg-10 mx-auto my-10">

<?php

// NOTE: Be sure to uncomment the following line in your php.ini file.
// ;extension=php_openssl.dll

// **********************************************
// *** Update or verify the following values. ***
// **********************************************

// Replace the accessKey string value with your valid access key.
$accessKey = '78814374242948be96db79bdcb902300';
#
// Verify the endpoint URI.  At this writing, only one endpoint is used for Bing
// search APIs.  In the future, regional endpoints may be available.  If you
// encounter unexpected authorization errors, double-check this value against
// the endpoint for your Bing Search instance in your Azure dashboard.
$endpoint = 'https://api.cognitive.microsoft.com/bing/v7.0/images/search';


			$sid =$_POST['songid'];
                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $dbname = "cs411";
			
			$flag = 0;
			$userarray = array ("new art","art","trending art","art","ancient art","art","nature","art","gloomy art");# we allocate 5 spots for usernames to be filled in
			$urls = array("","","","","","","","","");			

	
#			print "Song Id: ". $sid . "\n";
			
                        $conn = new mysqli($servername, $username, $password, $dbname);
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                        echo "Connected successfully<br>";

                        $sql = "SELECT S.Title AS Title
                                FROM Song S
                              	WHERE S.songID ='$sid'";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0){
                        while($row = $result->fetch_assoc()){
                                echo "Song Name: ". $row["Title"];
                                echo "<br>";
                        }}
			else {  echo "0 results";
                                echo  "<br>";}

			$sql = "SELECT U.Username AS username
                                FROM Collaborates C,User U
                                WHERE C.songID ='$sid'
				AND U.userID = C.userID";

                        $result = $conn->query($sql);
			
			
			#for testing purposes
			if ($result->num_rows > 4){
			#echo "I changed flag";
			#echo $result->num_rows;
			$flag = 1;}

			if ($result->num_rows > 0 && $flag == 0){
			$count = 1;
		#	echo "<4";
			print "Artists: ";
                        while($row = $result->fetch_assoc()){
                          #      echo "Username: ". $row["username"];
                         #       echo "<br>";
				echo $row["username"] . " , ";
				$userarray[$count] = $row["username"];
				$count = $count + 2;
                        }}

			else if ($result->num_rows > 0 && $flag == 1){
                        $count = 1;
                        print "Artists: ";
			while($row = $result->fetch_assoc()){
                        #        echo "Username: ". $row["username"];
                         #	 echo "<br>";
			#	echo ">5";
			#	echo "Artists: ";
				echo $row["username"] . " , ";
                                $userarray[$count] = $row["username"];
                                if($count == 3 or $count == 4){$count = $count + 1;}
				else{$count = $count + 2;}
                        }}


							
                        else {  echo "0 results";
				echo  "<br>";}



	#	print "Song Id: ". $sid . "\n";
	#	print "Song Name:" . "\n";
		echo '<br>';
#		print "Artists: ";#this is for testing purposes only!!!!










                  #  for($x = 0; $x < 9; $x++){ # run through images to find urls
		#	print $userarray[$x]." , ";
		#	echo '<br>';
		#	}    
		#echo '<br>';


#$term = $userarray[$x];

function BingImageSearch ($url, $key, $query) {
    // Prepare HTTP request
    // NOTE: Use the key 'http' even if you are making an HTTPS request. See:
    // http://php.net/manual/en/function.stream-context-create.php
    $headers = "Ocp-Apim-Subscription-Key: $key\r\n";
    $options = array ( 'http' => array (
                           'header' => $headers,
                           'method' => 'GET' ));

    // Perform the Web request and get the JSON response
    $context = stream_context_create($options);
    $result = file_get_contents($url . "?q=" . urlencode($query), false, $context);

    // Extract Bing HTTP headers
    $headers = array();
    foreach ($http_response_header as $k => $v) {
        $h = explode(":", $v, 2);
        if (isset($h[1]))
            if (preg_match("/^BingAPIs-/", $h[0]) || preg_match("/^X-MSEdge-/", $h[0]))
                $headers[trim($h[0])] = trim($h[1]);
    }

    return array($headers, $result);
}





                    for($x = 0; $x < 9; $x++){ # run through images to find urls
                #	print $userarray[$x]." , ";
                #	echo '<br>';
                #	}
                #echo '<br>';


$term = $userarray[$x];



if (strlen($accessKey) == 32) {

#   print "Searching images for: " . $term . "\n";

  list($headers, $json) = BingImageSearch($endpoint, $accessKey, $term);

 #  print "\nRelevant Headers:\n\n";
  foreach ($headers as $k => $v) {
  #   print $k . ": " . $v . "\n";
 }





 #  print "\nJSON Response:\n\n";
#    echo json_encode(json_decode($json), JSON_PRETTY_PRINT);

$jsonIterator = new RecursiveIteratorIterator(	#parse json iterator
    new RecursiveArrayIterator(json_decode($json, TRUE)),
    RecursiveIteratorIterator::SELF_FIRST);

    $randnum = rand(1,20);			 # pick from top 20
    $count = 0; 				#counter for current iteration 
#echo $randnum;
echo '<br>';
foreach ($jsonIterator as $key => $val) { #iterate through jsons and show one image based on randnum 
	if(($key == 'contentUrl') and($count != $randnum)){
	$count = $count + 1;
	}
	 if(($key == 'contentUrl') and ($count == $randnum)){
        	$count = $count + 1;
		$urls[$x] = $val;}
}


} else {

    print("Invalid Bing Search API subscription key!\n");
    print("Please paste yours into the source code.\n");

}}

?>
	<img src='<?php echo $urls[0] ?>' height="200" width="200" >	
	<img src='<?php echo $urls[1] ?>' height="200" width="200" >
	<img src='<?php echo $urls[2] ?>' height="200" width="200" >
	<br>
	<img src='<?php echo $urls[3] ?>' height="200" width="200" >
	<img src='<?php echo $urls[4] ?>' height="200" width="200" >
	<img src='<?php echo $urls[5] ?>' height="200" width="200" >
	<br>
	<img src='<?php echo $urls[6] ?>' height="200" width="200" >
	<img src='<?php echo $urls[7] ?>' height="200" width="200" >
	<img src='<?php echo $urls[8] ?>' height="200" width="200" >
	<br>
	<br>













                 <p id="debug">Debugging</p>

                

                <!-- Buttons -->
                <button onclick="displayAudio()">Display</button>
                <button onclick="playAudio()">Play</button>
                <button onclick="pauseAudio()">Pause</button>


                <!-- PHP -->
                <?php
			#echo $sid;
                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $dbname = "cs411";
                        $clips = array();

                        if($sid == ""){
                                exit("Error: No song id defined");
                        }


                        $sql = "SELECT clipID
                                FROM Consists
                                WHERE songID = '$sid'";
                        $result = $conn->query($sql);
			
			#echo "hello"; 
                        
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

