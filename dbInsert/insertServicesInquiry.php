<?php
session_start();

//db connection
include('../db/connect.php');

//fixed fields
$businessJustification = $_POST['businessJustification'];
$rfqType = 'Service Inquiry';
//REQUEST NO GENERATOR
//request type and series
	$type = 'RFQ';

include('requestNoGen.php');
//END REQUEST NO GENERATOR

// system date and time
include('../db/systemTime.php');
// end system date

//INSERT REQUEST PARENT DETAILS requestNo, businessJustification, dateNeeded, requestor, employeeNo, managerNo
$insertParent = "Insert into rfq (requestNo, businessJustification,requestor, employeeNo, managerNo, datePosted,rfqType) values('$Rn','$businessJustification','$requestorName','$employeeNo','$managerNo','$datePosted','$rfqType')";
$result = mysql_query($insertParent) or die (mysql_error());

//INSERT OF LINE ITEM DETAILS
	$natureOfService = $_POST['cmbService'];
	$startDate = $_POST['dateStart'];
	$endDate = $_POST['dateEnd'];
	$suggestedSupplier = $_POST['suggestedSupplier'];
	
	//UPLOADING OF FILE
	include('normalUpload.php');
	
	//INSERT ITEM TO DATABASE
	$insertChild = "Insert into rfq_service values('$Rn','$natureOfService','$startDate','$endDate','$suggestedSupplier')";
	$result = mysql_query($insertChild) or die (mysql_error());

//MESSAGE FOR HISTORY
$message = 'Service Inquiry';

//HISTORY
include('history.php');

header('Location: ../requestor/inquiries.php?msg=Request was successfully sent.');

?>