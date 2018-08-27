<?php
     	$target_dir = "clips/";
        $target_file = $target_dir . basename($_FILES["myfile"]["name"]);
	if(file_exists($target_file))
	{
		if(move_uploaded_file($_FILES["myfile"]["tmp_name"], $target_file))
		{
                        echo basename($_FILES["myfile"]["name"]) . " uploaded.<br>";
                }
                else
                {
                        echo "Error: File cannot upload.<br>";
                }
	}
	else
	{
		echo "Error: File does not exist.<br>";
	}
?>
