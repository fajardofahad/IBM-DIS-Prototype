<?php
//NORMAL UPLOAD (MANUAL UPLOADING OF FILE)

//file upload
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
				//requestNo, name, type, size, content, itemLine
				$query = "INSERT INTO uploadfiles (requestNo, name, type, size, content, itemLine ) ".
				"VALUES ('$Rn','$fileName', '$fileType', '$fileSize', '$content','1')";

				mysql_query($query) or die('Error, query failed');

				//echo "<br>File $fileName uploaded<br>";
			}
			
			if($_FILES['attachment2']['size'] > 0)
			{
				$fileName = $_FILES['attachment2']['name'];
				$tmpName  = $_FILES['attachment2']['tmp_name'];
				$fileSize = $_FILES['attachment2']['size'];
				$fileType = $_FILES['attachment2']['type'];

				$fp      = fopen($tmpName, 'r');
				$content = fread($fp, filesize($tmpName));
				$content = addslashes($content);
				fclose($fp);

				if(!get_magic_quotes_gpc())
				{
    				$fileName = addslashes($fileName);
				}
				//requestNo, name, type, size, content, itemLine
				$query = "INSERT INTO uploadfiles (requestNo, name, type, size, content, itemLine ) ".
				"VALUES ('$Rn','$fileName', '$fileType', '$fileSize', '$content','1')";

				mysql_query($query) or die('Error, query failed');

				//echo "<br>File $fileName uploaded<br>";
			}


?>