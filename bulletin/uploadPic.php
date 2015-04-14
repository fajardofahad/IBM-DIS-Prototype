<?php

// image uploader

if(isset($_POST['userfile']))
{
        $fileName = $_FILES['userfile']['name'];
        $tmpName  = $_FILES['userfile']['tmp_name'];
        $fileSize = $_FILES['userfile']['size'];
        $fileType = $_FILES['userfile']['type'];
        $idNo     = $_POST["idNo"];

        $fp = fopen($tmpName, 'r');
        $content = fread($fp, $fileSize);
        $content = addslashes($content);
        fclose($fp);

        if(!get_magic_quotes_gpc())
        {
            $fileName = addslashes($fileName);
        }

        $query = "INSERT INTO bulletin_image (bNo, type, size, content) ".
                 "VALUES ('$idNo', '$fileSize', '$fileType', '$content')";

        mysql_query($query) or die('Error, query failed');


        
}
?>
