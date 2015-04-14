<?php
session_start();
include("../db/connect.php");
include('../db/systemTime.php');

$requestorName = $_SESSION['NAME'];
$Rn = $_GET['requestID'];
$message = $_POST['messageField'];
$respondent = '';
$accronim = substr($Rn,0,3);

if($accronim == 'RFQ'){
	$sqlTable = 'rfq';
}elseif($accronim == 'ABN'){
	$sqlTable = 'abn';
}elseif($accronim == 'DIR'){
	$sqlTable = 'dir';
}elseif($accronim == 'MIR'){
	$sqlTable = 'mir';
}

$update = 'Update '.$sqlTable.' set requestorCheck = 5,procurementCheck = 5 where requestNo = \''.$Rn.'\'';
$result = mysql_query($update) or die (mysql_error());

include('../dbInsert/history.php');

header('location: inboxInquiries.php?msg=Message for '.$Rn.' was successfuly sent. Request has been opened.');
?>
