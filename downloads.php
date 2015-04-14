<?php
session_start();
session_destroy();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Home</title>
<link href="css/verdana.css" rel="stylesheet" type="text/css" />
<link href="css/sddm.css" rel="stylesheet" type="text/css" />
<!-- *********************************START ERROR CHECKER LOGIN****************************** -->
<script type="text/JavaScript">
<!--
function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_validateForm() { //v4.0
  var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
  for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=MM_findObj(args[i]);
    if (val) { nm=val.name; if ((val=val.value)!="") {
      if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
        if (p<1 || p==(val.length-1)) errors+='- '+nm+' must contain an e-mail address.\n';
      } else if (test!='R') { num = parseFloat(val);
        if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
        if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
          min=test.substring(8,p); max=test.substring(p+1);
          if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
    } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' is required.\n'; }
  } if (errors) alert('The following error(s) occurred:\n'+errors);
  document.MM_returnValue = (errors == '');
}
//-->
</script>
<!-- *********************************END ERROR CHECKER LOGIN****************************** -->
</head>
<body>
<form action="processIndex.php" method="post" name="frmindex" onsubmit="MM_validateForm('Email','','RisEmail','Password','','R');return document.MM_returnValue">
<table>
<tr><td colspan="2"><img src="images/Header.gif" width="900" height="175" /></td></tr>
<tr><td colspan="2" align="right" background="images/nav.jpg"></td></tr>
<tr><td width="216" valign="top" >

<!-- *********************************Start Left Menu****************************** -->
<?php
include("dropdownmenu/menu.php");
echo '<br>';
//include("dropdownmenu/bulletintopicsmenu.php");
?>
<!-- *********************************End Left Menu****************************** -->
<br><br />
</td>
<td width="717" valign="top">
<!-- *********************************START CENTER MENU****************************** -->
<img align="right" src="images/downloads.JPG"/>
  <br /><br /><br /><br /><br />
  
  <table width="590" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#3399FF">
      <tr>
        <td width="140" height="17" align="center" valign="middle" bgcolor="#819ADD" class="Orange_font"><strong>Name</strong></td>
        <td width="205" align="center" valign="middle" bgcolor="#819ADD" class="Orange_font"><strong>Description</strong></td>
        <td width="142" align="center" valign="middle" bgcolor="#819ADD" class="Orange_font"><strong>Size</strong></td>
        <td width="98" align="center" valign="middle" bgcolor="#819ADD" class="Orange_font"><strong>Download</strong></td>
      </tr>
	  <?php
	  include("db/connect.php");
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
        		<td align="center" valign="middle" bgcolor="#546ACA" class="style10 style21"><a href="downloader/download.php?id='.$id.'" style="color:#064293"><img src="images/attachment.gif" border="0" /></a></td>
      			</tr>';
				
			}
		}
	  ?>
</table>
<!-- *********************************END CENTER MENU****************************** -->

<!-- *********************************START RIGHT MENU****************************** -->

<!-- *********************************END RIGHT MENU****************************** -->
<script type="text/javascript" src="css/xpmenuv21.js"></script>
</div></td>
</tr></table>
</form>
</body>
</html>
