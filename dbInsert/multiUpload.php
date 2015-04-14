<?php
//MULTI UPLOAD (MULTIPLE UPLOADING OF FILE)

//file upload
			if($_FILES['attachment1'.$i]['size'] > 0)
			{
				$fileName = $_FILES['attachment1'.$i]['name'];
				$tmpName  = $_FILES['attachment1'.$i]['tmp_name'];
				$fileSize = $_FILES['attachment1'.$i]['size'];
				$fileType = $_FILES['attachment1'.$i]['type'];

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
				"VALUES ('$Rn','$fileName', '$fileType', '$fileSize', '$content','$i')";

				mysql_query($query) or die('Error, query failed');

				//echo "<br>File $fileName uploaded<br>";
			}
			
			if($_FILES['attachment2'.$i]['size'] > 0)
			{
				$fileName = $_FILES['attachment2'.$i]['name'];
				$tmpName  = $_FILES['attachment2'.$i]['tmp_name'];
				$fileSize = $_FILES['attachment2'.$i]['size'];
				$fileType = $_FILES['attachment2'.$i]['type'];

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
				"VALUES ('$Rn','$fileName', '$fileType', '$fileSize', '$content','$i')";

				mysql_query($query) or die('Error, query failed');

				//echo "<br>File $fileName uploaded<br>";
			}


?>