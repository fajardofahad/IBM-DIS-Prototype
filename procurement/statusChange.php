<?php
session_start();

include('../db/connect.php');
$NoOfItems = $_REQUEST['NoOfItems'];
	
	if(isset($_REQUEST['NoOfItems'])){
		
		for($z=0;$z<$NoOfItems;$z++){
			
			if(isset($_POST['checkboxD'.($z+1)])){
				$checkBoxValue = $_POST['checkboxD'.($z+1)];
								
				$sql_cmbNature = 'Select * from download where id = \''.$checkBoxValue.'\'';
				$result = mysql_query($sql_cmbNature) or die(mysql_error());
				$num = mysql_num_rows($result);
					
					if ($num > 0) {
						for($i=0; $i<$num; $i++) {
							$row = array();
							$row = mysql_fetch_array($result);
							
							$stats = $row['status'];
							
							if($stats == 'Inactive'){
							
								$update = 'Update download set status = \'Active\' where id = \''.$checkBoxValue.'\'';
								$result1 = mysql_query($update) or die (mysql_error());
								
							}
							
							if($stats == 'Active'){
							
								$update2 = 'Update download set status = \'Inactive\' where id = \''.$checkBoxValue.'\'';
								$result1 = mysql_query($update2) or die (mysql_error());
								
							}
						}
				
				}
			}
		}
	}
	
	header('Location: downloads.php?msg=Status successful changed.');

?>