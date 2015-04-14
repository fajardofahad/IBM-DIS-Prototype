<?php
//Generation of request number

//employee Details
$departmentCode = $_SESSION['DEPARTMENTCODE'];
$requestorName = $_SESSION['NAME'];
$employeeNo = $_SESSION['EMPLOYEENO'];
$managerNo = $_SESSION['MANAGERNO'];

	//SELECT QUERY IN ibsprocurement schema
	$select = "Select * from requestno where type = '$type'";
				
	//EXECUTION OF SQL QUERY
	$resultQuery = mysql_query($select) or die(mysql_error());
	$numRows = mysql_num_rows($resultQuery);
				
		if ($numRows != 0){
			while($row = mysql_fetch_array($resultQuery)){
					
				$series = $row['series'];
									
			}
		}
		
	$series_iterated = $series + 1;
	
	//UPDATE SERIES
	$update = "Update requestno set series='$series_iterated' where type = '$type'";
	$result = mysql_query($update) or die (mysql_error());	

//year and month
$year = date('Y');
$month = date('m');

$Rn = $type.'-'.$departmentCode.'-'.$year.$month.'-'.$series;
//End Generation of request number

?>