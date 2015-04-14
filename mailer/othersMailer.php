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

$mail->WordWrap = 50;                              // set word wrap
//$mail->AddAttachment("admin/bio.jpg", "file.jpg");      // attachment
//$mail->AddAttachment("admin/palm.jpg", "new.jpg"); 
$mail->IsHTML(true);     // send as HTML
$messages = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<style type="text/css">
<!--
.style3 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #064293;
}
.style10 {
	font-family: Verdana;
	font-size: 18px;
	color: #064293;
	font-weight: bold;
}
.redMarks {
color: #FF0000;
}
-->
</style>
</head>

<body>
<table width="750" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="5" class="style3"><strong><span class="style3">Request Number : '.$lastRowID.' </span> </strong></td>
    </tr>
  <tr>
    <td width="181" class="style3">&nbsp;</td>
    <td width="201" class="style3">&nbsp;</td>
    <td width="4" rowspan="3" class="style3">&nbsp;</td>
    <td width="182" class="style3">&nbsp;</td>
    <td width="182" class="style3">&nbsp;</td>
    </tr>
  <tr>
    <td colspan="2" class="style3"><strong>Request Type : '.$thisrequestType.'</strong></td>
    <td width="182" class="style3">&nbsp;</td>
    <td width="182" class="style3"><strong>Date Posted : '.$datePosted.'</strong></td>
  </tr>
  <tr>
    <td class="style3">&nbsp;</td>
    <td width="201" class="style3">&nbsp;</td>
    <td width="182" class="style3">&nbsp;</td>
    <td width="182" class="style3">&nbsp;</td>
  </tr>
  <tr>
    <td class="style3"><strong>Requestor details</strong></td>
    <td width="201" class="style3">&nbsp;</td>
    <td width="4" class="style3">&nbsp;</td>
    <td width="182" class="style3"><strong>Form details </strong></td>
    <td width="182" class="style3">&nbsp;</td>
  </tr>
  <tr>
    <td class="style3">&nbsp;</td>
    <td width="201" class="style3">&nbsp;</td>
    <td width="4" rowspan="4" bgcolor="#0066FF" class="style3">&nbsp;</td>
    <td width="182" class="style3">&nbsp;</td>
    <td width="182" align="center" class="style3">&nbsp;</td>
  </tr>
  <tr>
    <td align="right" class="style3"><span class="redMarks">*</span> Requestor First name:</td>
    <td align="center" bgcolor="#ECE9D8" class="style3">'.$thistxtRequestorFirstName.'</td>
    <td align="right" class="style3"><span class="redMarks">*</span> Description :</td>
    <td align="center" bgcolor="#ECE9D8" class="style3">'.$thistxtDescription.'</td>
    </tr>
  <tr>
    <td align="right" class="style3">&nbsp;</td>
    <td align="center" class="style3">&nbsp;</td>
    <td align="right" class="style3">&nbsp;</td>
    <td align="center" class="style3">&nbsp;</td>
    </tr>
  <tr>
    <td align="right" class="style3"><span class="redMarks">* </span>Requestor E-mail address:</td>
    <td align="center" bgcolor="#ECE9D8" class="style3">'.$thistxtRequestorEmail.'</td>
    <td align="right" class="style3">&nbsp;</td>
    <td align="center" class="style3">&nbsp;</td>
  </tr>
  
  <tr>
    <td align="right" class="style3">&nbsp;</td>
    <td align="right" class="style3">&nbsp;</td>
    <td class="style3" bgcolor="#0066FF">&nbsp;</td>
    <td align="left" class="style3">&nbsp;</td>
    <td class="style3">&nbsp;</td>
  </tr>
  <tr>
    <td align="right" class="style3">&nbsp;</td>
    <td align="right" class="style3">&nbsp;</td>
    <td class="style3">&nbsp;</td>
    <td align="left" class="style3">&nbsp;</td>
    <td class="style3">&nbsp;</td>
  </tr>
</table>

</body>
</html>
';
$messages .= '<br><br><br>IBS Procurement Team<br>Tel. Nos. 995-2938, 995-2961, 995-2990<br>Fax. 995-2792';

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

?>
