<?php
session_start();

include('../db/connect.php');
include('../db/systemTime.php');
if(isset($_POST['description'])){
$description = $_POST['description'];
}
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
				$query = "INSERT INTO download (name, type, size, content, status, dateUpload, description) ".
				"VALUES ('$fileName', '$fileType', '$fileSize', '$content','Active','$datePosted','$description')";

				mysql_query($query) or die('Error, query failed');

				//echo "<br>File $fileName uploaded<br>";
			}
			
			header('Location: downloads.php?msg=Upload successful. ');
?>