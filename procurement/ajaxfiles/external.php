<?php 
session_start();
include("../../db/connect.php");
//include("../validate.php");

$requestNo = $_GET['idInquiry'];
$rfqType = $_GET['idRfqType'];

//details
echo '<h3 style="border-bottom: 1px solid #C0C0C0; margin-bottom: -5px">Request Details : </h3><br />';
echo '<b>Request No : </b>'.$requestNo.'<br />';
echo '<b>Request Type : </b>'.$rfqType.'<br /><br />';

// requestNo, itemNo, items, quantity, size, color, material, features, brand, modelNo, partNo, others, dateNeeded
if($rfqType == 'Basic Item Inquiry'){

	include('../basicItemsInquiryDetails.php');
	
}elseif($rfqType == 'Service Inquiry'){

	include('../serviceInquiryDetails.php');
	
}elseif($rfqType == 'Customized Pre-Printed Inquiry'){

	include('../prePrintedInquiryDetails.php');
	
}elseif($rfqType == 'Customized Item Inquiry'){

	include('../itemInquiryDetails.php');
	
}elseif($rfqType == 'Manpower Inquiry'){

	include('../manpowerInquiryDetails.php');
	
}		
include('../attachment.php');			
//history
echo '<br /><h3 style="border-bottom: 1px solid #C0C0C0; margin-bottom: -5px">Request History : </h3><br />';
// history header
echo'<table width="620" border="0" cellpadding="0" cellspacing="1" bgcolor="#FFFFFF">
          <tr>
           <td width="112" height="21" align="center" valign="middle" bgcolor="#333333" class="small"><strong>Transaction Date</strong></td>
            <td width="190" align="center" valign="middle" bgcolor="#333333" class="small"><strong>Name </strong></td>
            <td width="314" align="center" valign="middle" bgcolor="#333333" class="small"><strong>Message</strong></td>
   </tr>';
  
  	 	$sql_history = 'Select * from history where requestNo = \''.$requestNo.'\' order by historyID DESC';
		$result = mysql_query($sql_history) or die(mysql_error());
		$num = mysql_num_rows($result);
		
			if ($num > 0) {
				for($i=0; $i<$num; $i++) {
					$row = array();
					$row = mysql_fetch_array($result);
	
				if($row['requestor'] != ""){
					$name = $row['requestor'];
				}elseif($row['respondent'] != ""){
					$name = $row['respondent'];
				}else{
					$name = 'DTS';
				}

				  echo ' <tr>
					<td height="21" align="center" valign="middle" bgcolor="#999999" class="small style1">'.$row['datePosted'].'</td>
					<td align="center" valign="middle" bgcolor="#999999" class="small style1">'.$name.'</td>
					<td align="center" valign="middle" bgcolor="#999999" class="small style1">'.$row['message'].'</td>
				  </tr>';
				  
				 }
			}


echo '</table>';
echo '<br /><h3 style="border-bottom: 1px solid #C0C0C0; margin-bottom: -5px">Message : </h3><br />';
echo '<br /><textarea name="messageField" cols="50" rows="5"></textarea><br /><br />';

//buttons
if($_GET['idStatus'] != 3 && $_GET['idStatus'] != 4){
echo '<input type="button" name="sendMessage" value="Send Message" onclick="JavaScript: sendMessages(\''.$requestNo.'\');" />';
echo '<a href="sendRequestQuote.php?idInquiry='.$requestNo.'&idRfqType='.$rfqType.'" target="_parent"><input type="button" name="sendRequest" value="Send to supplier" border="0" /></a>';
}

echo '<a href="previewQuote.php?idInquiry='.$requestNo.'&idRfqType='.$rfqType.'" target="_child"><input type="button" name="previewQuote" value="Preview Quotation" border="0" /></a>';

if($_GET['idStatus'] != 3 && $_GET['idStatus'] != 4){
echo '<input type="button" name="cancelRequests" value="Cancel Request" onclick="JavaScript: cancelRequest(\''.$requestNo.'\');" />';

echo '<input type="button" name="closeRequests" value="Close Request" onclick="JavaScript: closeRequest(\''.$requestNo.'\');" />';
}

if($_GET['idStatus'] == 3 || $_GET['idStatus'] == 4){
echo '<input type="button" name="openRequests" value="Open Request" onclick="JavaScript: openRequest(\''.$requestNo.'\');" />';
}


?>
 

