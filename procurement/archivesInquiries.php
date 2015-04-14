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
<table width="974">
<?php include("../header.php"); ?>
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


	<div align="left" style="float:left"><img src="../images/Archives.gif" width="67" height="75" border="0"/></div>
	<div align="left" style="float:inherit"><img align="right" src="../images/inquiries.JPG"/></div>





  
<!-- *********************************END CENTER MENU****************************** --></td>
</tr></table>
</form>
</body>
</html>
