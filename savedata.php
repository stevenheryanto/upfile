<?php
	$i;
	//echo $date;
	$strictExt = array("msi", "exe", "scr", "tif", "lnk");
	$temp = explode(".", $_FILES["file"]["name"]);
	$extension = end($temp);
	
	if ((!in_array($extension, $strictExt))	&& ($_FILES["file"]["size"] != 0)){
		if ($_FILES["file"]["error"] > 0){
			echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
			echo "You can reupload later";
			$i = 3;
		} else {
			chdir("files");
			$directory = "files/";
			$ftemp = preg_replace("/[^A-Za-z0-9]/", "", $_FILES["file"]["name"]);
			$fname = substr(strtolower($ftemp), 0, 18).".". strtolower($extension);
			//echo $fname;
			
			if (file_exists($fname)){
				echo $fname . " already exists. ";
				$i = 1;
			} else {
				move_uploaded_file($_FILES["file"]["tmp_name"], $fname );
				$location = $directory . $fname;
				$i = 3;
			}		
		}
	} elseif($_FILES["file"]["size"] == 0){
		$i = 3;
	} else {
		echo "Invalid file";
		echo "Type: " . $_FILES["file"]["name"] . "<br>".$extension."<br>";
		$i = 4;
	}
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>