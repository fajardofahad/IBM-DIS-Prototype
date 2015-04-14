<?php
session_start();
include("../validate.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Home</title>
<link href="../css/verdana.css" rel="stylesheet" type="text/css" />
<link href="../css/sddm.css" rel="stylesheet" type="text/css" />

</head>
<body>
<form action="processIndex.php" method="post" name="frmindex" onsubmit="MM_validateForm('Email','','RisEmail','Password','','R');return document.MM_returnValue">
<table>
<tr><td colspan="2"><img src="../images/Header.gif" width="900" height="175" /></td></tr>
<tr><td colspan="2" align="right" background="../images/nav.jpg"></td></tr>
<tr><td width="206" valign="top" >

<!-- *********************************Start Left Menu****************************** -->
<?php
include("../dropdownmenu/welcome.php");
echo '<br>';
include("../dropdownmenu/requestormenu.php");
echo '<br>';

?>
<!-- *********************************End Left Menu****************************** -->
<br>
<br />
</td>
<td width="739" align="center" valign="top">
<!-- *********************************START CENTER MENU****************************** -->
<img align="right" src="../images/downloads.JPG"/>
  <br />
  <br /><br /><br /><br />
  
  <table width="590" border="0" cellpadding="0" cellspacing="1" bgcolor="#3399FF">
      <tr>
        <td width="140" height="17" align="center" valign="middle" bgcolor="#819ADD" class="Orange_font"><strong>Name</strong></td>
        <td width="205" align="center" valign="middle" bgcolor="#819ADD" class="Orange_font"><strong>Description</strong></td>
        <td width="142" align="center" valign="middle" bgcolor="#819ADD" class="Orange_font"><strong>Size</strong></td>
        <td width="98" align="center" valign="middle" bgcolor="#819ADD" class="Orange_font"><strong>Download</strong></td>
      </tr>
	  <?php
	  include("../db/connect.php");
	  	$sql_cmbNature = 'Select * from download where status = \'Active\'';
		$result = mysql_query($sql_cmbNature) or die(mysql_error());
		$num = mysql_num_rows($result);
			
			if ($num > 0) {
				for($i=0; $i<$num; $i++) {
					$row = array();
					$row = mysql_fetch_array($result);
					
					$name = $row['name'];
					$description = $row['description'];
					$size = $row['size'];
					$id = $row['id'];
					
	 				 echo '<tr>
       			<td align="center" valign="middle" bgcolor="#546ACA" class="style10 style21">'.$name.'</td>
        		<td align="center" valign="middle" bgcolor="#546ACA" class="style10 style21">'.$description.'</td>
        		<td align="center" valign="middle" bgcolor="#546ACA" class="style10 style21">'.$size.' kb</td>
        		<td align="center" valign="middle" bgcolor="#546ACA" class="style10 style21"><a href="../downloader/download.php?id='.$id.'" style="color:#064293"><img src="../images/attachment.gif" border="0" /></a></td>
      			</tr>';
				
			}
		}
	  ?>
</table>
<!-- *********************************END CENTER MENU****************************** -->


<script type="text/javascript" src="css/xpmenuv21.js"></script>
</div></td>
</tr></table>
</form>
</body>
</html>
