<?php 
include("../db/connect.php");

if(isset($_GET['id']))
{
    $id      = $_GET['id'];
    $query   = "SELECT name, type, size, content FROM download WHERE id = '$id'";
    $result  = mysql_query($query) or die('Error, query failed');
    list($name, $type, $size, $content) = mysql_fetch_array($result);

    header("Content-Disposition: attachment; filename=$name");
    header("Content-length: $size");
    header("Content-type: $type");
    echo $content;

    //include 'library/closedb.php';    
    exit;
}
?>