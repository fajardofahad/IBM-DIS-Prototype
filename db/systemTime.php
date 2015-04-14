<?php

$query1="Select NOW();";
$result = mysql_query($query1) or die (mysql_error());
$num1 = mysql_num_rows($result);
			
	for($i=0; $i<$num1; $i++) {
		
		$row = mysql_fetch_array($result);
		$datePosted = $row[$i];
	}
	
?>