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
</head>
<body>
<form  method="post" name="frmMainRequestor">
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
<img align="right" src="../images/bulletin.JPG"/>
  <br />
  <br /><br /><br /><br />
  <div  align="center"style="height:400px;width:570px; overflow: auto;">
    <?php
	
		$query='Select * from bulletin order by bulletinId DESC;';
		$result = mysql_query($query) or die (mysql_error());
		$num = mysql_num_rows($result);
		
		if($num>0){ //IF ROW HAS VALUE
		
			while($row = mysql_fetch_array($result)){ // DATA EXTRACTION
				//bulletinId, content, bulletinDate, title
				$BulletinID = $row['bulletinId'];
				$Topic = $row['title'];
				$Introduction = $row['content'];
				$DateUpload = $row['bulletinDate'];
				echo '<table width="547" height="134" border="0" cellpadding="0" cellspacing="0">
					  <tr>
						<td width="106" align="center" valign="middle">
						<div style="height:80px;width:95px;"><img src="../bulletin/showImage.php?imageid='.$BulletinID.'"" width="95" height="80" /> </div>						</td>
						<td width="441">
						<div style="height:120px;width:440px; overflow:auto" align="justify">
						  <blockquote>
						    <p>
						      <strong>'.$Topic.'</strong> , '.$DateUpload.'<br />
						      <br />
						      '.$Introduction.'					        </p>
					      </blockquote>
						</div>						</td>
					  </tr>
					  <tr>
					    <td height="14" colspan="2" align="center" valign="middle" bgcolor="#999999">&nbsp;</td>
		    </tr>
					</table>';
				
				
			}
				
		}
	?>
  </div>
  <!-- *********************************END CENTER MENU****************************** -->
<script type="text/javascript" src="../css/xpmenuv21.js"></script>
</td>
</tr></table>
</form>
</body>
</html>
