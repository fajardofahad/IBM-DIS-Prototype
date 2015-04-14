<?php
session_start();

//db connection
include('../db/connect.php');

//fixed fields
$noOfItems = $_POST['noOfItems'];
$businessJustification = $_POST['businessJustification'];
$rfqType = 'Manpower Inquiry';
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

	$cmbContractCatalog = $_POST['cmbContractCatalog'];
	$txtSpecialCatalog = $_POST['txtSpecialCatalog'];
	
	//GET TYPE OF CATALOG
	if($cmbContractCatalog != "-" && $txtSpecialCatalog == ""){
	
		$typeCatalog = $cmbContractCatalog;
		
	}elseif($cmbContractCatalog == "-" && $txtSpecialCatalog != ""){
	
		$typeCatalog = $txtSpecialCatalog;
	}
	
	
	$contractorName = $_POST['contractorName'];
	$vendor = $_POST['vendor'];
	$designation = $_POST['designation'];
	$department = $_POST['department'];
	$immediateSupervisor = $_POST['immediateSupervisor'];
	$others = $_POST['others'];
	$dateStart = $_POST['dateStart'];
	$dateEnd = $_POST['dateEnd'];
		
	//UPLOADING OF FILE
	include('normalUpload.php');
	
	//INSERT ITEM TO DATABASE	
	$insertChild = "Insert into rfq_manpower values('$Rn','$typeCatalog','$contractorName','$vendor','$designation','$department','$immediateSupervisor','$dateStart','$dateEnd','$others','$noOfItems')";
	$result = mysql_query($insertChild) or die (mysql_error());

}elseif($noOfItems>1){

	for($i=1;$i<=$noOfItems;$i++){
	
			
		$cmbContractCatalog = $_POST['cmbContractCatalog'.$i];
		$txtSpecialCatalog = $_POST['txtSpecialCatalog'.$i];
	
			//GET TYPE OF CATALOG
			if($cmbContractCatalog != "-" && $txtSpecialCatalog == ""){
			
				$typeCatalog = $cmbContractCatalog;
				
			}elseif($cmbContractCatalog == "-" && $txtSpecialCatalog != ""){
			
				$typeCatalog = $txtSpecialCatalog;
			}
		
		$contractorName = $_POST['contractorName'.$i];
		$vendor = $_POST['vendor'.$i];
		$designation = $_POST['designation'.$i];
		$department = $_POST['department'.$i];
		$immediateSupervisor = $_POST['immediateSupervisor'.$i];
		$others = $_POST['others'.$i];
		$dateStart = $_POST['dateStart'.$i];
		$dateEnd = $_POST['dateEnd'.$i];
		
		//UPLOADING OF FILE
		include('multiUpload.php');
		
		//INSERT ITEM TO DATABASE	
		$insertChild = "Insert into rfq_manpower values('$Rn','$typeCatalog','$contractorName','$vendor','$designation','$department','$immediateSupervisor','$dateStart','$dateEnd','$others','$i')";
	$result = mysql_query($insertChild) or die (mysql_error());

	}

}

//MESSAGE FOR HISTORY
$message = 'Manpower Inquiry';

//HISTORY
include('history.php');

header('Location: ../requestor/inquiries.php?msg=Request was successfully sent.');

?>