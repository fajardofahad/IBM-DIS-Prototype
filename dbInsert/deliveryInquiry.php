<?php
session_start();

//db connection
include('../db/connect.php');

//fixed fields
$cartId = $_POST['DeliveryInquiry'];

//REQUEST NO GENERATOR
//request type and series
	$type = 'DIR';

include('requestNoGen.php');
//END REQUEST NO GENERATOR

// system date and time
include('../db/systemTime.php');
// end system date

//INSERT REQUEST PARENT DETAILS requestNo, businessJustification, dateNeeded, requestor, employeeNo, managerNo
$insertParent = "Insert into dir (requestNo, cartId, requestor, employeeNo, managerNo, datePosted) values('$Rn','$cartId','$requestorName','$employeeNo','$managerNo','$datePosted')";
$result = mysql_query($insertParent) or die (mysql_error());

//MESSAGE FOR HISTORY
$message = 'Delivery Inquiry Sent';

//HISTORY
include('history.php');

header('Location: ../requestor/inquiries.php?msg=Delivery Inquiry was successfully sent.');

?>