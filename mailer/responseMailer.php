
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="../css/site.css">
<script type="text/javascript" src="../javascript/loadingHandler2.js" language="javascript"></script>
</head>
<body>
<?php

//session_start();


$ID = $_POST['ID'];
$CC = $_POST['textCC'];
$Message = $_POST['textMessage'];
$RequestType = $_POST['RequestType'];
$InitiatorEmail = $_POST['InitiatorEmail'];
$Pfname = $_SESSION['sFirstName'];
$Plname = $_SESSION['sLastName'];
$Pposition = $_SESSION['sPosition'];
$Pemail = $_SESSION['sEmail'];
$Pcontactno = $_SESSION['sContactNo'];

include('../_requires/connect.php');
// get initiators e-mail
	$RequestorFollowup2='Select * from requestdetails where rn = \''.$ID.'\';';
	$result = mysql_query($RequestorFollowup2) or die (mysql_error());
	$num = mysql_num_rows($result);	 

	if($num>0){
	
	$row = mysql_fetch_array($result);
	$InitiatorEmail = $row['initiatorEmail'];
	$thisrequestType = $row['requestType'];
	$thistxtRequestorFirstName = $row['requestorName'];
	$thistxtRequestorEmail = $row['requestorEmail'];
	$thistxtBusinessJustification = $row['businessJustification'];
	}
	// end of get
	
		// internal declarations
		$thistransactionType = "Request Responded";
		$thistransactionStatus = "Responded";
		$InitiatorFirstName = "";
		$thismessage = $Message;
		$thisrespondent = $Pfname;
			// system date and time
			$query1="Select NOW();";
			$result = mysql_query($query1) or die (mysql_error());
			$num1 = mysql_num_rows($result);
			
			for($i=0; $i<$num1; $i++) {
		
				$row = mysql_fetch_array($result);
				$datePosted = $row[$i];
			}
	// end system date
			
			
			// db requesthistory ( transactionNo, rn, dateTime, transactionType, initiator, respondent, message, transactionStatus )
			$insert = "Insert into requesthistory (rn, dateTime, transactionType, initiator, respondent, message, transactionStatus) values('$ID','$datePosted','$thistransactionType','$InitiatorFirstName','$thisrespondent','$thismessage','$thistransactionStatus')";
			$result = mysql_query($insert) or die (mysql_error());
			// end of third insert 
			$insert1 = "Update requestdetails set requestStatus='Responded' where rn = $ID";
			$result = mysql_query($insert1) or die (mysql_error());

$smtpAccess='Select username,password from smtp';
	$smtpResult = mysql_query($smtpAccess) or die (mysql_error());
	$num = mysql_num_rows($smtpResult);	 
	$row = mysql_fetch_array($smtpResult);
	$screenname = $row['username'];
	$password = $row['password'];
	
	
require("class.phpmailer.php");

$mail = new PHPMailer();



$mail->IsSMTP();                                   // send via SMTP
$mail->Host     = "ph.ibm.com"; // SMTP servers
$mail->SMTPAuth = true;     // turn on SMTP authentication
$mail->Username = $screenname;  // SMTP username
$mail->Password = $password; // SMTP password

//function resetter(){

	$mail->ClearAddresses();
	$mail->ClearAllRecipients();
	$mail->ClearAttachments();
	$mail->ClearBCCs();
	$mail->ClearCCs();
	$mail->ClearCustomHeaders();
	$mail->ClearReplyTos();	
//}


$mail->From     = "iprocure@ph.ibm.com";
$mail->FromName = "DTS Mailer";
$mail->AddAddress($InitiatorEmail);

if(isset($_POST['textCC'])){ 
	$tok = strtok($CC, ",");

	while ($tok !== false) {
	
 		$mail->AddCC(trim($tok));
   		$tok = strtok(",");
	}
	
}
//$mail->AddAddress("iprocure@ph.ibm.com");               // optional name
//$mail->AddReplyTo("fahadfajardo@gmail.com","me");

$mail->WordWrap = 50;                              // set word wrap
//$mail->AddAttachment("admin/bio.jpg", "file.jpg");      // attachment
//$mail->AddAttachment("admin/palm.jpg", "new.jpg"); 
$mail->IsHTML(true);     // send as HTML

$messages = $Message;

$messages .= '<br /><br /><br />';


$messages .= '
  <table width="745" border="0" cellspacing="0" cellpadding="0">
  <tr>
	<td colspan="6" align="center" bgcolor="#FFFFFF" class="style3"><strong>History</strong></td>
  </tr>
  
  <tr>
    <td colspan="6" align="center" bgcolor="#FFFFFF" class="style3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="center" bgcolor="#FFFFFF" class="style3">&nbsp;</td>
    <td width="179" align="center" bgcolor="#FFFFFF" class="style3">&nbsp;</td>
    <td width="350" align="center" bgcolor="#FFFFFF" class="style3"><strong>Request Number : '.$ID.'</strong></td>
    <td width="212" colspan="2" align="center" bgcolor="#FFFFFF" class="style3">&nbsp;</td>
  </tr>
  
  <tr>
    <td colspan="6" align="center" bgcolor="#FFFFFF" class="style3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="6" align="left" bgcolor="#FFFFFF" class="style3"><table width="747" cellspacing="1">
      <tr>
    <td width="115" align="center" bgcolor="#0099FF" class="style3"><strong>Initiator</strong></td>
    <td width="138" align="center" bgcolor="#0099FF" class="style3"><strong>Respondent</strong></td>
    <td width="105" align="center" bgcolor="#0099FF" class="style3"><strong>Status</strong></td>
    <td width="231" align="center" bgcolor="#0099FF" class="style3"><strong>Message</strong></td>
    <td width="140" align="center" bgcolor="#0099FF" class="style3"><strong>Time</strong></td>
  </tr>
   

';
//$ID = $_GET['ID'];
// SEARCH FOR history
		$HistorySearch='Select * from requesthistory where rn = '.$ID.' order by transactionNo DESC';
		$HistoryResult = mysql_query($HistorySearch) or die (mysql_error());
		//$num = mysql_num_rows($HistoryResult);	 
		//$row = mysql_fetch_array($HistoryResult);
$i=1;
while($row = mysql_fetch_array($HistoryResult)){
		//history details
		//transactionNo, rn, , transactionType, , , , 
		$thistxtInitiator = $row['initiator'];		
		$thistxtRespondent = $row['respondent'];	
		$thistxtStatus = $row['transactionStatus'];	
		$thistxtMessage = $row['message'];	
		$thistxtTime = $row['dateTime'];
		
			if($i==1){
				$Color = "#FFFFFF";
				$i++;
			}elseif($i==2){
				$Color = "#E0DFE3";
				$i--;
			}
			
	$messages .=  '<tr>
    <td align="center" bgcolor="'.$Color.'" class="style3">'.$thistxtInitiator.'</td>
    <td align="center" bgcolor="'.$Color.'" class="style3">'.$thistxtRespondent.'</td>
    <td align="center" bgcolor="'.$Color.'" class="style3">'.$thistxtStatus.'</td>
    <td align="center" bgcolor="'.$Color.'" class="style3">'.$thistxtMessage.'</td>
    <td align="center" bgcolor="'.$Color.'" class="style3">'.$thistxtTime.'</td>
  </tr>
';
  }

$messages .=  ' </table></td>
  </tr>
</table>
';


$messages .= "<br><br><br>".$Pfname." ".$Plname."<br>".$Pposition.", IBS Procurement<br>".$Pemail."<br>Tel. No(s). ".$Pcontactno."<br>Fax. 995-2792";

if($RequestType == "Delivery"){
// SEARCH FOR delivery
		$deliverySearch='Select * from delivery,requestdetails,requestors where requestdetails.initiatorEmail = requestors.requestorEmail and requestdetails.rn = delivery.rn and requestdetails.rn = '.$ID;
		$deliveryResult = mysql_query($deliverySearch) or die (mysql_error());
		$num = mysql_num_rows($deliveryResult);	 
		$row = mysql_fetch_array($deliveryResult);
				
		$thistxtCartId = $row['cartId'];
		
	$mail->Subject  =  "RE : ".$thistxtCartId;
	
}elseif($RequestType == "Approved bond notification / For PO issuance"){
	// SEARCH FOR bondnotification
		$bondnotificationSearch='Select * from bondnotification,requestdetails,requestors where requestdetails.initiatorEmail = requestors.requestorEmail and requestdetails.rn = bondnotification.rn and requestdetails.rn = '.$ID;
		$bondnotificationResult = mysql_query($bondnotificationSearch) or die (mysql_error());
		$num = mysql_num_rows($bondnotificationResult);	 
		$row = mysql_fetch_array($bondnotificationResult);
		
		$thistxtCartId = $row['1'];
		
	$mail->Subject  =  "RE : ".$thistxtCartId;
	
}else{
	$mail->Subject  =  "RE : ".$lastRowID;
}


$mail->Body     =  $messages;
//$mail->AltBody  =  $messages;

if(!$mail->Send())
{
   echo "Your E-mail address may be wrong or you entered the wrong E-mail address. <p>";
   echo "Mailer Error: " . $mail->ErrorInfo;
   header('location: ../index.php?msg=Your E-mail address may be wrong or you entered the wrong E-mail address');
   exit;
}
	
	$mail->ClearAddresses();
	$mail->ClearAllRecipients();
	$mail->ClearAttachments();
	$mail->ClearBCCs();
	$mail->ClearCCs();
	$mail->ClearCustomHeaders();
	$mail->ClearReplyTos();	
	
	
			//echo '<br /><br />Success';
			
	header('Location: ../procurement/popup_request.php?ID='.$ID);

?>
</body>
</html>