<?php
session_start();
include("../connect.php");
include("../validate.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Administrator Page</title>
<link href="../css/verdana.css" rel="stylesheet" type="text/css" />
<link href="../css/sddm.css" rel="stylesheet" type="text/css" />
</head>
<body>
<form action="#" method="post" name="frmMainRequestor">
<table>
<?php include("../header.php"); ?>
<tr><td colspan="2" align="right" background="../images/nav.jpg"></td></tr>
<tr><td width="188" valign="top" >

<!-- *********************************Start Left Menu****************************** -->
<?php
include("../dropdownmenu/welcome.php");
echo '<br>';
include("../dropdownmenu/administratormenu.php");
echo '<br>';
include("../dropdownmenu/bulletintopicsmenu.php");
?>
<!-- *********************************End Left Menu****************************** -->
<br><br />
</td>
<td valign="top">
<!-- *********************************START CENTER MENU****************************** -->
<img align="right" src="../images/bulletin.JPG"/>
  <br /><br /><br /><br /><br />
  
  Your Message and Code goes here!!
<!-- *********************************END CENTER MENU****************************** -->
<script type="text/javascript" src="../css/xpmenuv21.js"></script>
</td>
</tr></table>
</form>
</body>
</html>