<?php
session_start();

include('../db/connect.php');
include('../db/systemTime.php');

//Slash Cleaner
function RTESafe($strText){

	$tmpString = $strText;
	
	$tmpString = trim($tmpString);
	
	$tmpString = stripslashes($tmpString);
	
	return $tmpString;
}

if(isset($_POST['titleBulletin'])){
$titleBulletin = RTESafe($_POST['titleBulletin']);
}

if(isset($_POST['contents'])){
$contents = RTESafe($_POST['contents']);
}
//bulletinId, content, bulletinDate, title
$insert1 = "Insert into bulletin (content, bulletinDate, title) values('$contents','$datePosted','$titleBulletin') ";
$result = mysql_query($insert1) or die (mysql_error());

			if($_FILES['attachment1']['size'] > 0)
			{
				$fileName = $_FILES['attachment1']['name'];
				$tmpName  = $_FILES['attachment1']['tmp_name'];
				$fileSize = $_FILES['attachment1']['size'];
				$fileType = $_FILES['attachment1']['type'];

				$fp      = fopen($tmpName, 'r');
				$content = fread($fp, filesize($tmpName));
				$content = addslashes($content);
				fclose($fp);

				if(!get_magic_quotes_gpc())
				{
    				$fileName = addslashes($fileName);
				}
				//id, name, type, size, content, status, dateUpload, description
				$query = "INSERT INTO bulletin_images (type, size, content) ".
				"VALUES ('$fileType', '$fileSize', '$content')";
//imageId, type, size, content
				mysql_query($query) or die('Error, query failed');

				//echo "<br>File $fileName uploaded<br>";
			}
			
			header('Location: bulletin.php?msg=Upload successful. ');
?>