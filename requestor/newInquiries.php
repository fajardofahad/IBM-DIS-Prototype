<?php
session_start();
include("../db/connect.php");
include("../validate.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Requestor Page</title>
<link href="../css/verdana.css" rel="stylesheet" type="text/css" />
<link href="../css/sddm.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript" > 


function ApprovedBondNotification(){
	var approvedBondNotification = document.forms['frmMainRequestor'].approvedBondNotification.value;
	
	if(approvedBondNotification == ""){
		alert("Cart ID must have a value.");
		document.forms['frmMainRequestor'].approvedBondNotification.focus();
	}else{
		document.forms['frmMainRequestor'].action = "../dbInsert/approvedBondNotification.php";
		document.forms['frmMainRequestor'].submit();
	}
}

function Delivery(){
	var DeliveryInquiry = document.forms['frmMainRequestor'].DeliveryInquiry.value;
	
	if(DeliveryInquiry == ""){
		alert("Cart ID must have a value.");
		document.forms['frmMainRequestor'].DeliveryInquiry.focus();
	}else{
		document.forms['frmMainRequestor'].action = "../dbInsert/deliveryInquiry.php";
		document.forms['frmMainRequestor'].submit();
	}
}

function MiscellaneousInquiry(){
	var Description = document.forms['frmMainRequestor'].Description.value;
	var Attachment = document.forms['frmMainRequestor'].attachment1.value;
	if(Description == ""){
		alert("Description must have a value.");
		document.forms['frmMainRequestor'].Description.focus();
	}else if(Attachment == ""){
		alert("Please have atleast one (1) attachment.");
		document.forms['requestForm'].attachment1.focus();
	}else{
		document.forms['frmMainRequestor'].action = "../dbInsert/miscellaneousInquiry.php";
		document.forms['frmMainRequestor'].submit();
	}
}

</script>
</head>
<body>
<form action="#" method="post" name="frmMainRequestor" enctype="multipart/form-data">
<table width="976">
<tr><td colspan="2"><img src="../images/Header.gif" width="900" height="175" /></td></tr>
<tr><td colspan="2" align="right" background="../images/nav.jpg"></td></tr>
<tr><td width="188" valign="top" >
<!-- *********************************Start Left Menu****************************** -->
<?php
include("../dropdownmenu/welcome.php");
echo '<br>';
include("../dropdownmenu/requestormenu.php");
echo '<br>';

?>
<!-- *********************************End Left Menu****************************** -->
<br><br />
</td>
<td align="center" valign="top">
  <!-- *********************************START CENTER MENU****************************** -->
	<div align="left" style="float:right;height:20px;width:40px"><img align="right" src="../images/inquiries.JPG"/></div>
	<br /><br /><a href="inquiries.php" ><img src="../images/prevArrorw.gif" align="left" border="0"/><br />
	<div align="left" class="colorwhite">
	<b>Back to Inquiries</b></div><br /><br />
	</a>
<?php
include("tabinquiries.php");
?><br />
	<!-- *********************************END CENTER MENU****************************** --></td>

<script type="text/javascript" src="../css/xpmenuv21.js"></script>
</tr></table>
</form>
</body>
</html>
