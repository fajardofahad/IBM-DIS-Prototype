<?php
session_start();
session_destroy();
include("db/connect.php");
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
<tr><td width="222" valign="top" >

<!-- *********************************Start Left Menu****************************** -->
<?php
include("dropdownmenu/loginmenu.php");
echo '<br>';
include("dropdownmenu/menu.php");
echo '<br>';
include("dropdownmenu/downloadmenu.php");
?>
<!-- *********************************End Left Menu****************************** -->
<br><br />
</td>
<td width="709" align="center" valign="top">
<!-- *********************************START CENTER MENU****************************** -->
<img align="right" src="images/bulletin.JPG"/>
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
						<div style="height:80px;width:95px;"><img src="bulletin/showImage.php?imageid='.$BulletinID.'"" width="95" height="80" /> </div>						</td>
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

<!-- *********************************START RIGHT MENU****************************** -->

<!-- *********************************END RIGHT MENU****************************** -->
<script type="text/javascript" src="css/xpmenuv21.js"></script>
</div></td>
</tr></table>
</form>
</body>
</html>
