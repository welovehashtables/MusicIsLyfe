<?php
	$clipid = $_POST["clipid"];
	$target_file = "clips/" . $clipid . ".mp3";
	echo $clipid;
	echo $target_file;	


	if(file_exists($target_file))
	{
		unlink($target_file);
		echo $clipid . " deleted.<br>";	
	}
	else
	{
		echo "Error: File does not exist. <br>";
	}
?>
