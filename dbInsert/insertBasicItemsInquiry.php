<?php
session_start();

//db connection
include('../db/connect.php');

//fixed fields
$noOfItems = $_POST['noOfItems'];
$DateNeeded = $_POST['dateNeeded'];
$businessJustification = $_POST['businessJustification'];
$rfqType = 'Basic Item Inquiry';
//REQUEST NO GENERATOR
//request type and series
	$type = 'RFQ';

include('requestNoGen.php');
//END REQUEST NO GENERATOR

// system date and time
include('../db/systemTime.php');
// end system date

//INSERT REQUEST PARENT DETAILS requestNo, businessJustification, dateNeeded, requestor, employeeNo, managerNo
$insertParent = "Insert into rfq (requestNo, businessJustification, requestor, employeeNo, managerNo, datePosted,rfqType) values('$Rn','$businessJustification','$requestorName','$employeeNo','$managerNo','$datePosted','$rfqType')";
$result = mysql_query($insertParent) or die (mysql_error());

//INSERT OF LINE ITEM DETAILS
if($noOfItems == 1){
	$items = $_POST['items'];
	$quantity = $_POST['quantity'];
	$size = $_POST['size'];
	$color = $_POST['color'];
	$material = $_POST['material'];
	$features = $_POST['features'];
	$brand = $_POST['brand'];
	$modelNo = $_POST['modelNo'];
	$partNo = $_POST['partNo'];
	$others = $_POST['others'];
	
	//UPLOADING OF FILE
	include('normalUpload.php');
	
	//INSERT ITEM TO DATABASE	
	$insertChild = "Insert into rfq_basic_item values('$Rn','$noOfItems','$items','$quantity','$size','$color','$material','$features','$brand','$modelNo','$partNo','$others','$DateNeeded')";
	$result = mysql_query($insertChild) or die (mysql_error());

}elseif($noOfItems>1){

	for($i=1;$i<=$noOfItems;$i++){
	
		$items = $_POST['items'.$i];
		$quantity = $_POST['quantity'.$i];
		$size = $_POST['size'.$i];
		$color = $_POST['color'.$i];
		$material = $_POST['material'.$i];
		$features = $_POST['features'.$i];
		$brand = $_POST['brand'.$i];
		$modelNo = $_POST['modelNo'.$i];
		$partNo = $_POST['partNo'.$i];
		$others = $_POST['others'.$i];
		
		//UPLOADING OF FILE
		include('multiUpload.php');
		
		//INSERT ITEM TO DATABASE	
		$insertChild = "Insert into rfq_basic_item  values('$Rn','$i','$items','$quantity','$size','$color','$material','$features','$brand','$modelNo','$partNo','$others','$DateNeeded')";
		$result = mysql_query($insertChild) or die (mysql_error());

	}

}

//MESSAGE FOR HISTORY
$message = 'Basic Item Inquiry';

//HISTORY
include('history.php');

header('Location: ../requestor/inquiries.php?msg=Request was successfully sent.');

?>