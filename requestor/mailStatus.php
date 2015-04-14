<?php

$mailStatus = $_GET['idStatus'];
$Rn = $_GET['idInquiry'];
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


	$update = 'Update '.$sqlTable.' set requestorCheck = 1 where requestNo = \''.$requestNo.'\'';
	$result = mysql_query($update) or die (mysql_error());


?>