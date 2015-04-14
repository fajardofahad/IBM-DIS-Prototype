<?php
   require_once('../db/connect.php');
   //imageId, type, size, content
   $imageId = $_GET["imageid"];
   $dbQuery = "SELECT type, content FROM bulletin_images WHERE imageId = '" . $imageId . "'";
   $result = mysql_query($dbQuery) or die("Couldn't get file list");

   if(mysql_num_rows($result) == 1) {
      $fileType = @mysql_result($result, 0, "type");
      $fileContent = @mysql_result($result, 0, "content");
      header("Content-type: $fileType");

      echo $fileContent;

}
?>