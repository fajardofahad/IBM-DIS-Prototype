<?php
session_start();
include("../db/connect.php");
include("../validate.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Procurement Page</title>
<link href="../css/verdana.css" rel="stylesheet" type="text/css" />
<link href="../css/sddm.css" rel="stylesheet" type="text/css" />
</head>
<body>
<form action="#" method="post" name="frmMainRequestor">
<table width="976">
<tr><td colspan="2"><img src="../images/Header.gif" width="900" height="175" /></td></tr>
<tr><td colspan="2" align="right" background="../images/nav.jpg"></td></tr>
<tr><td width="188" valign="top" >

<!-- *********************************Start Left Menu****************************** -->
<?php
include("../dropdownmenu/welcome.php");
echo '<br>';
include("../dropdownmenu/procurementmenu.php");
echo '<br>';

?>
<!-- *********************************End Left Menu****************************** -->
<br><br />
</td>
<td align="center" valign="top">
<!-- *********************************START CENTER MENU****************************** -->
<img align="right" src="../images/inquiries.JPG"/>
  <br />
  <div align="left" ><div style="width:250px"><?php 
  
  if(isset($_GET['msg'])){
		$msg = $_GET['msg'];
		echo "<span class=\"errorMsg\"><b>". $msg ."</b></span>";
	}
	?></div></div>
	<br />
	<br />
	<br /><br />
  
  <a href="inboxInquiries.php"><img src="../images/Inbox.gif" border="0"/></a><br>
  <br>
  <a href="outboxInquiries.php"><img src="../images/Outbox.gif" border="0"/></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <a href="archivesInquiries.php"><img src="../images/Archives.gif" border="0"/></a>
<!-- *********************************END CENTER MENU****************************** -->
</td>

<script type="text/javascript" src="../css/xpmenuv21.js"></script>

</tr></table>
</form>
</body>
</html>
