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

<script type="text/javascript" language="javascript">
function UploadFile(){
	if(document.forms['frmindex'].description.value == ""){
		alert("Descriptionmust have a value.");
		document.forms['frmindex'].description.focus();
	}else if(document.forms['frmindex'].attachment1.value == ""){
		alert("Please attach atleas 1 file.");
	}else{
		document.forms['frmindex'].action = "upload.php";
		document.forms['frmindex'].submit();
	}
}

function DeleteFile(){
var flag = 1;	
var NoOfItems = document.forms['frmindex'].elements['checkboxesD[]'].length;
	
	for(z=0;z<NoOfItems;z++){
		if(document.forms['frmindex'].elements['checkboxesD[]'][z].checked == true){
			flag =2;
		}
	}
		
	if(flag == 2){
		document.forms['frmindex'].action = "delete.php?NoOfItems="+NoOfItems;
		document.forms['frmindex'].submit();
		
	}else{
		alert("Please select atleast 1 item.");
	}
	
}

function ChangeFile(){
var flag = 1;	
var NoOfItems = document.forms['frmindex'].elements['checkboxesD[]'].length;
	
	for(z=0;z<NoOfItems;z++){
		if(document.forms['frmindex'].elements['checkboxesD[]'][z].checked == true){
			flag =2;
		}
	}
		
	if(flag == 2){
		document.forms['frmindex'].action = "statusChange.php?NoOfItems="+NoOfItems;
		document.forms['frmindex'].submit();
		
	}else{
		alert("Please select atleast 1 item.");
	}
	
}

function checkAllBoxD(){
var NoOfItems = document.forms['frmindex'].elements['checkboxesD[]'].length;

	if(document.forms['frmindex'].checkboxAllD.checked == true){
		for(z=0;z<NoOfItems;z++){
			document.forms['frmindex'].elements['checkboxesD[]'][z].checked = true;
		}
		
	}else if(document.forms['frmindex'].checkboxAllD.checked == false){
		for(z=0;z<NoOfItems;z++){
			document.forms['frmindex'].elements['checkboxesD[]'][z].checked = false;
		}
		
	}
}
</script>
</head>
<body>
<form  method="post" name="frmindex" enctype="multipart/form-data" >
<table>
<tr><td colspan="2"><img src="../images/Header.gif" width="900" height="175" /></td></tr>
<tr><td colspan="2" align="right" background="../images/nav.jpg"></td></tr>
<tr><td width="206" valign="top" >

<!-- *********************************Start Left Menu****************************** -->
<?php
include("../dropdownmenu/welcome.php");
echo '<br>';
include("../dropdownmenu/procurementmenu.php");
echo '<br>';

?>
<!-- *********************************End Left Menu****************************** -->
<br>
<br />
</td>
<td width="739" align="left" valign="top">
<!-- *********************************START CENTER MENU****************************** --><br />
   <table width="732" border="0" cellpadding="1" cellspacing="1">
    <tr>
      <td width="292" align="left" valign="top"><span style="width:250px">
        <?php 
  
  if(isset($_GET['msg'])){
		$msg = $_GET['msg'];
		echo "<span class=\"errorMsg\"><b>". $msg ."</b></span>";
	}
	?>
      </span></td>
      <td width="433" align="right" valign="middle"><img align="right" src="../images/downloads.JPG"/></td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
      </tr>
    <tr>
      <td colspan="2" align="right" valign="middle"><input name="Clear Form" type="reset" id="Clear Form" value="Clear Form" />
        <input name="Upload" type="button" id="Upload" value="Upload" onclick="JavaScript: UploadFile();" />
        <input name="Delete" type="button" id="Delete" value="Delete" onclick="JavaScript: DeleteFile();" />
        <input name="status" type="button" id="status" value="Change Status" onclick="JavaScript: ChangeFile();" /></td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2"><table width="722" border="0" cellpadding="1" cellspacing="1">
        <tr>
          <td width="103" align="right" valign="middle"><strong>* Description : </strong></td>
          <td width="154"><input name="description" type="text" id="description" /></td>
          <td width="99" align="right" valign="middle"><strong>* Attachment :</strong></td>
          <td>
		  <input type="hidden" name="MAX_FILE_SIZE1" value="2000000"><input type="file" name="attachment1" />		  </td>
          </tr>
      </table></td>
      </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" align="center" valign="top">
	  <div align="left" style="height:200px;width:710px; overflow: auto;">
	    <table width="681" border="0" cellpadding="0" cellspacing="1" bgcolor="#3399FF">
          <tr>
            <td width="32" height="17" align="center" valign="middle" bgcolor="#819ADD" class="Orange_font"><input type="checkbox" name="checkboxAllD" value="checkAllCheckedD" onclick="JavaScript: checkAllBoxD();" /></td>
            <td width="107" align="center" valign="middle" bgcolor="#819ADD" class="Orange_font"><strong>Name</strong></td>
            <td width="206" align="center" valign="middle" bgcolor="#819ADD" class="Orange_font"><strong>Description</strong></td>
            <td width="142" align="center" valign="middle" bgcolor="#819ADD" class="Orange_font"><strong>Size</strong></td>
            <td width="93" align="center" valign="middle" bgcolor="#819ADD" class="Orange_font"><strong>Download</strong></td>
            <td width="85" align="center" valign="middle" bgcolor="#819ADD" class="Orange_font"><strong>Status</strong></td>
          </tr>
          <?php
	  include("../db/connect.php");
	  	$sql_cmbNature = 'Select * from download';
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
					$status = $row['status'];
	 				 echo '
					 <tr>
					<td width="32" height="17" align="center" valign="middle" bgcolor="#546ACA" class="style10 style21"><input type="checkbox" name="checkboxD'.($i+1).'" value="'.$id.'" id="checkboxesD[]" /></td>
					<td width="107" align="center" valign="middle" bgcolor="#546ACA" class="style10 style21">'.$name.'</td>
					<td width="206" align="center" valign="middle" bgcolor="#546ACA" class="style10 style21">'.$description.'</td>
					<td width="142" align="center" valign="middle" bgcolor="#546ACA" class="style10 style21">'.$size.' kb</td>
					<td width="93" align="center" valign="middle" bgcolor="#546ACA" class="style10 style21"><a href="../downloader/download.php?id='.$id.'" style="color:#064293"><img src="../images/attachment.gif" border="0" /></a></td>
					<td width="85" align="center" valign="middle" bgcolor="#546ACA" class="style10 style21">'.$status.'</td>
				  </tr>
				
					';
				
			}
		}
	  ?>
        </table>
	  </div>	  </td>
      </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
      </tr>
  </table>
  <br />
  <!-- *********************************END CENTER MENU****************************** -->
<script type="text/javascript" src="css/xpmenuv21.js"></script>
</div></td>
</tr></table>
</form>
</body>
</html>
