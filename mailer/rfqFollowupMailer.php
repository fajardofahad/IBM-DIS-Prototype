<?php

$smtpAccess='Select username,password from smtp';
	$smtpResult = mysql_query($smtpAccess) or die (mysql_error());
	$num = mysql_num_rows($smtpResult);	 
	$row = mysql_fetch_array($smtpResult);
	$screenname = $row['username'];
	$password = $row['password'];
	
	echo $screenname;
	echo $password;

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
$mail->AddAddress($InitiatorEmail,$InitiatorFirstName); 
//$mail->AddAddress("iprocure@ph.ibm.com");               // optional name
//$mail->AddReplyTo("fahadfajardo@gmail.com","me");

$mail->WordWrap = 300;                              // set word wrap
//$mail->AddAttachment("admin/bio.jpg", "file.jpg");      // attachment
//$mail->AddAttachment("admin/palm.jpg", "new.jpg"); 
$mail->IsHTML(true);                               // send as HTML
$messages = "<br><br><b>Request Number : </b>".$RN;
$messages .= "<br><b>Request Type : </b>".$thisrequestType;
$messages .= "<br><b>Requestor Name : </b>".$thistxtRequestorFirstName;
$messages .= "<br><b>Requestor E-mail Address : </b>".$thistxtRequestorEmail;
$messages .= "<br><b>Follow-up date : </b>".$datePosted;
$messages .= "<br><br><b> Business Justification : </b>".$thistxtBusinessJustification;

$messages .= "<br><br><b> History : </b>";
$messages .= "<br><br><table width=\"799\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><tr>
    <td width=\"138\" height=\"21\" align=\"center\" valign=\"middle\" bgcolor=\"#00FFFF\" class=\"style3\"><strong >Date and Time </strong></td>
    <td width=\"170\" align=\"center\" valign=\"middle\" bgcolor=\"#00FFFF\" class=\"style3\"><strong>Transaction Type </strong></td>
    <td width=\"110\" align=\"center\" valign=\"middle\" bgcolor=\"#00FFFF\" class=\"style3\"><strong>Initiator</strong></td>
    <td width=\"111\" align=\"center\" valign=\"middle\" bgcolor=\"#00FFFF\" class=\"style3\"><strong>Respondent</strong></td>
    <td width=\"169\" align=\"center\" valign=\"middle\" bgcolor=\"#00FFFF\" class=\"style3\"><strong>Message</strong></td>
    <td width=\"101\" align=\"center\" valign=\"middle\" bgcolor=\"#00FFFF\" class=\"style3\"><strong>Status</strong></td>
  </tr>";
//
$RequestorFollowup3='Select * from requesthistory where rn = \''.$RN.'\'';
	$result3 = mysql_query($RequestorFollowup3) or die (mysql_error());
	$num3 = mysql_num_rows($result3);	 

//if($num3>0){

//transactionNo, rn, dateTime, transactionType, initiator, respondent, message, transactionStatus
	//$row3 = mysql_fetch_array($result3);
	$flag=1;
	while($row3 = mysql_fetch_row($result3))
	{
				//$txtmessages = $row3[6]; 
				//echo '<br>'.$txtmessages;
				//echo '<br>'.$row3[6];
		if($flag==1){
		$messages .= "<tr>
   		 <td align=\"center\" valign=\"middle\" bgcolor=\"#FFFFFF\">".$row3[2]."</td>
   		 <td align=\"center\" valign=\"middle\" bgcolor=\"#FFFFFF\">".$row3[3]."</td>
   		 <td align=\"center\" valign=\"middle\" bgcolor=\"#FFFFFF\">".$row3[4]."</td>
   		 <td align=\"center\" valign=\"middle\" bgcolor=\"#FFFFFF\">".$row3[5]."</td>
   		 <td align=\"center\" valign=\"middle\" bgcolor=\"#FFFFFF\">".$row3[6]."</td>
		 <td align=\"center\" valign=\"middle\" bgcolor=\"#FFFFFF\">".$row3[7]."</td>
		 </tr>";
		 $flag=2;
		 }elseif($flag==2){
		 $messages .= "<tr>
   		 <td align=\"center\" valign=\"middle\" bgcolor=\"#CCCCCC\">".$row3[2]."</td>
   		 <td align=\"center\" valign=\"middle\" bgcolor=\"#CCCCCC\">".$row3[3]."</td>
   		 <td align=\"center\" valign=\"middle\" bgcolor=\"#CCCCCC\">".$row3[4]."</td>
   		 <td align=\"center\" valign=\"middle\" bgcolor=\"#CCCCCC\">".$row3[5]."</td>
   		 <td align=\"center\" valign=\"middle\" bgcolor=\"#CCCCCC\">".$row3[6]."</td>
		 <td align=\"center\" valign=\"middle\" bgcolor=\"#CCCCCC\">".$row3[7]."</td>
		 </tr>";
		 $flag=1;
		 }
			
	//}
}
$messages .= "</table>".$txt;
$messages .= "<br><br><br>IBS Procurement Team<br>Tel. Nos. 995-2938, 995-2961, 995-2990<br>Fax. 995-2792";

$mail->Subject  =  "IBS Procurement Digital Tracking System Request Number : ".$lastRowID;
$mail->Body     =  $messages;
//$mail->AltBody  =  $messages;

if(!$mail->Send())
{
   echo "Your E-mail address may be wrong or you entered the wrong E-mail address. <p>";
   echo "Mailer Error: " . $mail->ErrorInfo;
   header('location: ../index.php?msg=Your E-mail address may be wrong or you entered the wrong E-mail address&sRequestPageState=1&sRegistrationState=1');
   exit;
}
	
	$mail->ClearAddresses();
	$mail->ClearAllRecipients();
	$mail->ClearAttachments();
	$mail->ClearBCCs();
	$mail->ClearCCs();
	$mail->ClearCustomHeaders();
	$mail->ClearReplyTos();	

echo '<br>h3ll0';
?>
