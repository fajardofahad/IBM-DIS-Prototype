<?php
session_start();

//db connection
include('../db/connect.php');

//fixed fields
$description = $_POST['Description'];

//REQUEST NO GENERATOR
//request type and series
	$type = 'MIR';

include('requestNoGen.php');
//END REQUEST NO GENERATOR

// system date and time
include('../db/systemTime.php');
// end system date

//INSERT REQUEST PARENT DETAILS requestNo, businessJustification, dateNeeded, requestor, employeeNo, managerNo
$insertParent = "Insert into mir (requestNo, description, requestor, employeeNo, managerNo, datePosted) values('$Rn','$description','$requestorName','$employeeNo','$managerNo','$datePosted')";
$result = mysql_query($insertParent) or die (mysql_error());

//UPLOADING OF FILE
include('normalUpload.php');
	
//MESSAGE FOR HISTORY
$message = 'Miscellaneous Inquiry Sent';

//HISTORY
include('history.php');

header('Location: ../requestor/inquiries.php?msg=Miscellaneous Inquiry was successfully sent.');

?>