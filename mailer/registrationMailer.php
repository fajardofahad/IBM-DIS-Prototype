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
$mail->AddAddress($thisrequestorEmail,$thisrequestorFname); 
//$mail->AddAddress("iprocure@ph.ibm.com");               // optional name
//$mail->AddReplyTo("fahadfajardo@gmail.com","me");

$mail->WordWrap = 50;                              // set word wrap
//$mail->AddAttachment("admin/bio.jpg", "file.jpg");      // attachment
//$mail->AddAttachment("admin/palm.jpg", "new.jpg"); 
$mail->IsHTML(true);                               // send as HTML
$messages = "<b>Your registration details in the DTS are the following : </b><br><br>";
$messages .= "<b>Requestor's Details</b><br><br>Last name : ".$thisrequestorLname."<br>First name : ".$thisrequestorFname."<br>Middle name : ".$thisrequestorMname."<br>E-mail Address : ".$thisrequestorEmail
			."<br>Floor Number : ".$thisrequestorFnumber."<br>Contact Number : ".$thisrequestorCnumber."<br>Department : ".$thisrequestorDepartment;
$messages .= "<br><br><br><b>Manager's Details</b><br><br>Manager's Last name : ".$thismanagerLname."<br>Manager's First name : ".$thismanagerFname."<br>Manager's E-mail Address : ".$thismanagerEmail."<br><br><br><br>Thank you for registering to the DTS. <br><br>You're now authorized to use DTS.";

$mail->Subject  =  "Welcome to IBS Procurement Digital Tracking System";
$mail->Body     =  $messages;
//$mail->AltBody  =  $messages;

if(!$mail->Send())
{
   echo "Your E-mail address may be wrong or you entered the wrong E-mail address. <p>";
   echo "Mailer Error: " . $mail->ErrorInfo;
   $delete1 = "Delete FROM requestors WHERE requestorEmail = '".$thisrequestorEmail."'"; 
   $result = mysql_query($delete1) or die (mysql_error());
   header('location: ../index.php?msg=Your E-mail address may be wrong or you entered the wrong E-mail address&sRegistrationState=1');
   exit;
}


//resetter(); // resets smtp for new smtp.
	$mail->ClearAddresses();
	$mail->ClearAllRecipients();
	$mail->ClearAttachments();
	$mail->ClearBCCs();
	$mail->ClearCCs();
	$mail->ClearCustomHeaders();
	$mail->ClearReplyTos();
	//$mail->Reset();

$mail->From     = "iprocure@ph.ibm.com";
$mail->FromName = "DTS Mailer";
$mail->AddAddress("iprocure@ph.ibm.com"); 
//$mail->AddAddress("iprocure@ph.ibm.com");               // optional name
//$mail->AddReplyTo("fafajardo@apc.edu.ph","me");

$mail->WordWrap = 50;                              // set word wrap
//$mail->AddAttachment("admin/bio.jpg", "file.jpg");      // attachment
//$mail->AddAttachment("admin/palm.jpg", "new.jpg"); 
$mail->IsHTML(true);                               // send as HTML
$messages = "<b>Requestor's registration details in the DTS are the following : </b><br><br>";
$messages .= "<b>Requestor's Details</b><br><br>Last name : ".$thisrequestorLname."<br>First name : ".$thisrequestorFname."<br>Middle name : ".$thisrequestorMname."<br>E-mail Address : ".$thisrequestorEmail
			."<br>Floor Number : ".$thisrequestorFnumber."<br>Contact Number : ".$thisrequestorCnumber."<br>Department : ".$thisrequestorDepartment;
$messages .= "<br><br><br><b>Manager's Details</b><br><br>Manager's Last name : ".$thismanagerLname."<br>Manager's First name : ".$thismanagerFname."<br>Manager's E-mail Address : ".$thismanagerEmail."<br><br><br><br>Thank you for registering to the DTS. <br><br>You're now authorized to use DTS.";

$mail->Subject  =  $thisrequestorLname.", ".$thisrequestorFname." registered to IBS Procurement Digital Tracking System";
$mail->Body     =  $messages;
//$mail->AltBody  =  $messages;

if(!$mail->Send())
{
   echo "Message was not sent <p>";
   echo "Mailer Error: " . $mail->ErrorInfo;
   exit;
}
?>
