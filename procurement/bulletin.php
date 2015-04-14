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
<script language="javascript" type="text/javascript" src="../rtf/richtext.js"></script>
<script language="javascript" type="text/javascript">
function UploadFiles(){
updateRTEs();
	
	if(document.forms['frmMainRequestor'].elements['titleBulletin'].value == ""){
		alert("Title must  have a value.");
		//document.forms['frmMainRequestor'].titleBulletin.focus();
	}else if(document.forms['frmMainRequestor'].elements['contents'].value == ""){
		alert("Content mus  have a value.");
		//document.forms['frmMainRequestor'].contents.focus();
	}else if(document.forms['frmMainRequestor'].attachment1.value == ""){
		alert("Please attach atleas 1 file.");
	}else{
		document.forms['frmMainRequestor'].action = "bulletinUpload.php";
		document.forms['frmMainRequestor'].submit();
	}
}
// Declaration of RTF paths
//Usage: initRTE(imagesPath, includesPath, cssFile)
initRTE("../images/rte/", "../rtf/", "rte.css");

</script>
<script type="text/javascript" language="javascript">
function DeleteFile(){
var flag = 1;	
var NoOfItems = document.forms['frmMainRequestor'].elements['checkboxesD[]'].length;
	
	for(z=0;z<NoOfItems;z++){
		if(document.forms['frmMainRequestor'].elements['checkboxesD[]'][z].checked == true){
			flag =2;
		}
	}
		
	if(flag == 2){
		document.forms['frmMainRequestor'].action = "BulletinDelete.php?NoOfItems="+NoOfItems;
		document.forms['frmMainRequestor'].submit();
		
	}else{
		alert("Please select atleast 1 item.");
	}
	
}

function checkAllBoxD(){
var NoOfItems = document.forms['frmMainRequestor'].elements['checkboxesD[]'].length;

	if(document.forms['frmMainRequestor'].checkboxAllD.checked == true){
		for(z=0;z<NoOfItems;z++){
			document.forms['frmMainRequestor'].elements['checkboxesD[]'][z].checked = true;
		}
		
	}else if(document.forms['frmMainRequestor'].checkboxAllD.checked == false){
		for(z=0;z<NoOfItems;z++){
			document.forms['frmMainRequestor'].elements['checkboxesD[]'][z].checked = false;
		}
		
	}
}


</script>
</head>
<body>
<form  method="post" name="frmMainRequestor" enctype="multipart/form-data">
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
<td align="left" valign="top">
<!-- *********************************START CENTER MENU****************************** -->
<img align="right" src="../images/bulletin.JPG"/>
  
  <span style="width:250px">
  <?php 
  
  if(isset($_GET['msg'])){
		$msg = $_GET['msg'];
		echo "<span class=\"errorMsg\"><b>". $msg ."</b></span>";
	}
	?>
  </span><br /><br />
  <br />
  <br /><br />
  <!-- *********************************END CENTER MENU****************************** -->
<script type="text/javascript" src="../css/xpmenuv21.js"></script>
<table width="794" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td colspan="2" align="right" valign="top"><input name="Clear Form" type="reset" id="Clear Form" value="Clear Form" />
      <input name="Upload" type="button" id="Upload" value="Upload" onclick="JavaScript: UploadFiles();" />
      <input name="Delete" type="button" id="Delete" value="Delete" onclick="JavaScript: DeleteFile();" /></td>
    </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
    </tr>
  <tr>
    <td height="93" colspan="2" align="left" valign="top">
	
	  <table width="619" border="0" cellspacing="1" cellpadding="1">
        <tr>
          <td width="150" align="right" valign="top">* Title : </td>
          <td width="462">
		  <script language="javascript" type="text/javascript">
		  	writeRichText('titleBulletin', '', 500, 50, true, false);
		  </script>		  </td>
        </tr>
        <tr>
          <td align="right" valign="middle">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td align="right" valign="top">* Content : </td>
          <td>
		  <script language="JavaScript" type="text/javascript">
				//Usage: writeRichText(fieldname, html, width, height, buttons, readOnly)
				writeRichText('contents', '', 500, 200, true, false);
			</script></td>
        </tr>
        <tr>
          <td align="right" valign="middle">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td height="27" align="right" valign="middle">* Attachment : </td>
          <td><input type="hidden" name="MAX_FILE_SIZE1" value="2000000"><input type="file" name="attachment1" /></td>
        </tr>
      </table></td>
    </tr>
  <tr>
    <td height="16" colspan="2" align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="center" valign="top"><div align="left" style="height:200px;width:765px; overflow: auto;">
      <table width="760" border="0" cellpadding="0" cellspacing="1" bgcolor="#3399FF">
        <tr>
          <td width="41" height="17" align="center" valign="middle" bgcolor="#819ADD" class="Orange_font"><input type="checkbox" name="checkboxAllD" value="checkAllCheckedD" onclick="JavaScript: checkAllBoxD();" /></td>
          <td width="559" align="center" valign="middle" bgcolor="#819ADD" class="Orange_font"><strong>Title</strong></td>
          <td width="174" align="center" valign="middle" bgcolor="#819ADD" class="Orange_font"><strong>Date</strong></td>
          </tr>
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
				
				echo '<tr>
          <td width="32" height="17" align="center" valign="middle" bgcolor="#546ACA" class="style10 style21"><input type="checkbox" name="checkboxD'.($i+1).'" value="'.$BulletinID.'" id="checkboxesD[]" /></td>
          <td width="224" align="center" valign="middle" bgcolor="#546ACA" class="style10 style21">'.$Topic.'</td>
          <td width="118" align="center" valign="middle" bgcolor="#546ACA" class="style10 style21">'.$DateUpload.'</td>
          </tr>';
				
				
			}
				
		}
	  ?>
      </table>
    </div></td>
    </tr>
  <tr>
    <td width="621">&nbsp;</td>
    <td width="221">&nbsp;</td>
  </tr>
</table></td>
</tr></table>
</form>
</body>
</html>
