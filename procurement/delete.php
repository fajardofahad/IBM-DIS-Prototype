<?php
session_start();

include('../db/connect.php');
$NoOfItems = $_REQUEST['NoOfItems'];
	
	if(isset($_REQUEST['NoOfItems'])){
		for($i=0;$i<$NoOfItems;$i++){
			
			if(isset($_POST['checkboxD'.($i+1)])){
				$checkBoxValue = $_POST['checkboxD'.($i+1)];
				$update = 'Delete From download where id = \''.$checkBoxValue.'\'';
				$result = mysql_query($update) or die (mysql_error());
			}
		}
	}
	
	header('Location: downloads.php?msg=Delete successful. ');

?>