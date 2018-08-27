<?php
	$clipid = "clips/" . $_POST['clipid'];
	echo $clipid . "<br>";
	if (file_exists($clipid)) {
		
	}
	else{
		echo "Error: clipid not found.";
	}
?>
