<?php
session_start();
include("../db/connect.php");
include("../validate.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="../css/tabcontent.css" />
<script type="text/javascript" src="../javascript/tabcontent.js">
</script>
<script type="text/javascript" language="javascript">
function checkAllBoxRFQ(){
var NoOfItems = document.forms['requestForm'].elements['checkboxesRFQ[]'].length;

	if(document.forms['requestForm'].checkboxAllRFQ.checked == true){
		for(z=0;z<NoOfItems;z++){
			document.forms['requestForm'].elements['checkboxesRFQ[]'][z].checked = true;
		}
		
	}else if(document.forms['requestForm'].checkboxAllRFQ.checked == false){
		for(z=0;z<NoOfItems;z++){
			document.forms['requestForm'].elements['checkboxesRFQ[]'][z].checked = false;
		}
		
	}
}

function checkAllBoxABN(){
var NoOfItems = document.forms['requestForm'].elements['checkboxesABN[]'].length;

	if(document.forms['requestForm'].checkboxAllABN.checked == true){
		for(z=0;z<NoOfItems;z++){
			document.forms['requestForm'].elements['checkboxesABN[]'][z].checked = true;
		}
		
	}else if(document.forms['requestForm'].checkboxAllABN.checked == false){
		for(z=0;z<NoOfItems;z++){
			document.forms['requestForm'].elements['checkboxesABN[]'][z].checked = false;
		}
		
	}
}

function checkAllBoxDIR(){
var NoOfItems = document.forms['requestForm'].elements['checkboxesDIR[]'].length;

	if(document.forms['requestForm'].checkboxAllDIR.checked == true){
		for(z=0;z<NoOfItems;z++){
			document.forms['requestForm'].elements['checkboxesDIR[]'][z].checked = true;
		}
		
	}else if(document.forms['requestForm'].checkboxAllDIR.checked == false){
		for(z=0;z<NoOfItems;z++){
			document.forms['requestForm'].elements['checkboxesDIR[]'][z].checked = false;
		}
		
	}
}

function checkAllBoxMIR(){
var NoOfItems = document.forms['requestForm'].elements['checkboxesMIR[]'].length;

	if(document.forms['requestForm'].checkboxAllMIR.checked == true){
		for(z=0;z<NoOfItems;z++){
			document.forms['requestForm'].elements['checkboxesMIR[]'][z].checked = true;
		}
		
	}else if(document.forms['requestForm'].checkboxAllMIR.checked == false){
		for(z=0;z<NoOfItems;z++){
			document.forms['requestForm'].elements['checkboxesMIR[]'][z].checked = false;
		}
		
	}
}
</script>
</head>

<body>
<?php
//sql queries declaration

$sql_rfq = 'Select * from rfq where requestor = \''.$_SESSION['NAME'].'\' and requestorFolder = 0 ';
$sql_abn = 'Select * from abn where requestor = \''.$_SESSION['NAME'].'\' and requestorFolder = 0 ';
$sql_dir = 'Select * from dir where requestor = \''.$_SESSION['NAME'].'\' and requestorFolder = 0 ';
$sql_mir = 'Select * from mir where requestor = \''.$_SESSION['NAME'].'\' and requestorFolder = 0 ';

// request no specific
if(isset($_REQUEST['searchRequestNo']) && $_REQUEST['searchRequestNo'] != ""){
	$rn = 'and requestNo = \''.$_REQUEST['searchRequestNo'].'\' ';
	$sql_rfq .= $rn;
	$sql_abn .= $rn;
	$sql_dir .= $rn;
	$sql_mir .= $rn;
}
// cart id specific
if(isset($_REQUEST['searchCartId']) && $_REQUEST['searchCartId'] != ""){
	$cartID = 'and cartId = \''.$_REQUEST['searchCartId'].'\' ';
	//$sql_rfq .= ;
	$sql_abn .= $cartID;
	$sql_dir .= $cartID;
	//$sql_mir .= ;

}
// date REQUESTed specific
if((isset($_REQUEST['DateStart']) && $_REQUEST['DateStart'] != "") && (isset($_REQUEST['DateEnd']) && $_REQUEST['DateEnd'] != "")){
	$dp = 'and (datePosted >= \''.$_REQUEST['DateStart'].'\' and datePosted <= \''.$_REQUEST['DateEnd'].'\') ';
	$sql_rfq .= $dp;
	$sql_abn .= $dp;
	$sql_dir .= $dp;
	$sql_mir .= $dp;

}
// request status specific
if($_REQUEST['searchRequestStatus'] != '-'){
	$rs = 'and requestorCheck = '.$_REQUEST['searchRequestStatus'].' ';
	$sql_rfq .= $rs;
	$sql_abn .= $rs;
	$sql_dir .= $rs;
	$sql_mir .= $rs;

}

// request sorting
if($_REQUEST['searchSorting'] != '-'){
	$sort = 'order by requestNo '.$_REQUEST['searchSorting'];
}elseif($_REQUEST['searchSorting'] == '-'){
	$sort = 'order by requestNo DESC';
}

//finalize sql statements
$sql_rfq .= $sort;
$sql_abn .= $sort;
$sql_dir .= $sort;
$sql_mir .= $sort;


///////////////////////////////////////////////////////////////////////////////////////

?>
<ul id="maintab" class="shadetabs">
<li class="selected"><a href="#" rel="tcontent1">Request for Quotation</a></li>
<li><a href="#" rel="tcontent2">Approved Bond Notification</a></li>
<li><a href="#" rel="tcontent3">Delivery Inquiry</a></li>
<li><a href="#" rel="tcontent4">Miscellaneous</a></li>
</ul>

<div class="tabcontentstyle" >
  <div id="tcontent1" class="tabcontent" align="left">
  
		<table width="760" border="0" cellpadding="0" cellspacing="1" bgcolor="#3399FF">
          <tr>
           <td width="56" align="center" valign="middle" bgcolor="#333333" class="Orange_font"><input type="checkbox" name="checkboxAllRFQ" value="checkAllCheckedRFQ" onclick="JavaScript: checkAllBoxRFQ();" /></td>
            <td width="160" align="center" valign="middle" bgcolor="#333333" class="Orange_font"><strong>Request No</strong></td>
            <td width="257" align="center" valign="middle" bgcolor="#333333" class="Orange_font"><strong>Business Justification</strong></td>
            <td width="180" align="center" valign="middle" bgcolor="#333333" class="Orange_font"><strong>Requestor </strong></td>
            <td width="95" align="center" valign="middle" bgcolor="#333333" class="Orange_font"><strong>Date Posted</strong></td>
            </tr>
		  </table>
  	<div style="height:200px;width:780px; overflow: auto;">
		<?php
		 include("../db/connect.php");
	  	//$sql_rfq = 'Select * from rfq where requestorFolder = 0 order by requestNo DESC';
		$result = mysql_query($sql_rfq) or die(mysql_error());
		$num = mysql_num_rows($result);
		
		//cell color checker
		$colorPicker = 1;
		$setColor = '';
		$imageMail = '';
		
			if ($num > 0) {
				for($i=0; $i<$num; $i++) {
					$row = array();
					$row = mysql_fetch_array($result);
					
					$requestNo = $row['requestNo'];
					$businessJustification = $row['businessJustification'];
					$requestor = $row['requestor'];
					$datePosted = $row['datePosted'];
					$rfqType = $row['rfqType'];
// note to change cell color you must declare color for style="background:#999999" & onmouseOut="this.style.backgroundColor=\'#999999\'"

// available colors are : gray = #999999, dark gray = #666666, light gray = #CCCCCC, beage = #FFCC66
// mail images 
/*	1 new mail = newMail.gif
	2 mail checked = mailChecked.gif
	3 responded = responded.gif

*/
					if($row['requestorCheck'] == 0 || $row['requestorCheck'] == 5){
						$setColor = '#FFCC66';
						$imageMail = 'newMail.gif';
					}elseif($row['requestorCheck'] == 1){
						$setColor = '#999999';
						$imageMail = 'mailChecked.gif';
					}elseif($row['requestorCheck'] == 2){#99CC66
						$setColor = '#666666';
						$imageMail = 'responded.gif';
					}elseif($row['requestorCheck'] == 3){
						$setColor = '#99CC66';
						$imageMail = 'mailfolders.gif';
					}elseif($row['requestorCheck'] == 4){
						$setColor = '#FF6666';
						$imageMail = 'delete.gif';
					}
					
		echo '<a href="javascript:ajaxpage(\'ajaxfiles/external.php?idInquiry='.$requestNo.'&idRfqType='.$rfqType.'&idStatus='.$row['requestorCheck'].'\', \'rightcolumn\');" >
			<div style="height: auto;width:773px;"  >
				<table   width="760" cellpadding="1" cellspacing="1" border="0" bgColor="#CCCCCC" >
					 <tr style="background:'.$setColor.'" onmouseOver="this.style.backgroundColor=\'#D7F2D2\'" onmouseOut="this.style.backgroundColor=\''.$setColor.'\'">
					<td width="56" height="17" align="center" valign="middle" class="small style1"><input type="checkbox" name="checkboxRFQ'.($i+1).'" value="'.$requestNo.'" id="checkboxesRFQ[]" /><img src="../images/'.$imageMail.'" border="0" /></td>
					<td width="160" align="center" valign="middle" class="small style1">'.$requestNo.'</td>
					<td width="257" align="center" valign="middle" class="small style1">'.$businessJustification.'</td>
					<td width="180" align="center" valign="middle" class="small style1">'.$requestor.'</td>
					<td width="95" align="center" valign="middle" class="small style1">'.$datePosted.'</td>
					</tr>
			  	</table>
			  </div>
		  </a>';
		  }
		 }
		
		?>
					
	</div>

</div>
<div id="tcontent2" class="tabcontent" align="left">
	<table width="714" border="0" cellpadding="0" cellspacing="1" bgcolor="#3399FF">
          <tr>
           <td width="56" align="center" valign="middle" bgcolor="#333333" class="Orange_font"><input type="checkbox" name="checkboxAllABN" value="checkAllCheckedABN" onclick="JavaScript: checkAllBoxABN();" /></td>
            <td width="206" align="center" valign="middle" bgcolor="#333333" class="Orange_font"><strong>Request No</strong></td>
            <td width="155" align="center" valign="middle" bgcolor="#333333" class="Orange_font"><strong>Cart ID </strong></td>
            <td width="196" align="center" valign="middle" bgcolor="#333333" class="Orange_font"><strong>Requestor </strong></td>
            <td width="160" align="center" valign="middle" bgcolor="#333333" class="Orange_font"><strong>Date Posted</strong></td>
	  </tr>
	  </table>
  	<div style="height:200px;width:740px; overflow: auto;">
		<?php
		 
	  	//$sql_abn = 'Select * from abn where requestorFolder = 0 order by requestNo DESC';
		$result = mysql_query($sql_abn) or die(mysql_error());
		$num = mysql_num_rows($result);
		
		//cell color checker
		$colorPicker = 1;
		$setColor = '';
		$imageMail = '';
		
			if ($num > 0) {
				for($i=0; $i<$num; $i++) {
					$row = array();
					$row = mysql_fetch_array($result);
										
					$requestNo = $row['requestNo'];
					$cartId = $row['cartId'];
					$requestor = $row['requestor'];
					$datePosted = $row['datePosted'];
					
// note to change cell color you must declare color for style="background:#999999" & onmouseOut="this.style.backgroundColor=\'#999999\'"

// available colors are : gray = #999999, dark gray = #666666, light gray = #CCCCCC, beage = #FFCC66
// mail images 
/*	1 new mail = newMail.gif
	2 mail checked = mailChecked.gif
	3 responded = responded.gif

*/
					if($row['requestorCheck'] == 0 || $row['requestorCheck'] == 5){
						$setColor = '#FFCC66';
						$imageMail = 'newMail.gif';
					}elseif($row['requestorCheck'] == 1){
						$setColor = '#999999';
						$imageMail = 'mailChecked.gif';
					}elseif($row['requestorCheck'] == 2){
						$setColor = '#666666';
						$imageMail = 'responded.gif';
					}elseif($row['requestorCheck'] == 3){
						$setColor = '#99CC66';
						$imageMail = 'mailfolders.gif';
					}elseif($row['requestorCheck'] == 4){
						$setColor = '#FF6666';
						$imageMail = 'delete.gif';
					}
					
		echo '<a href="javascript:ajaxpage(\'ajaxfiles/external2.php?idInquiry='.$requestNo.'&idStatus='.$row['requestorCheck'].'\', \'rightcolumn\');" >
			<div style="height: auto;width:714px;"  >
				<table  width="714" cellpadding="1" cellspacing="1" border="0" bgColor="#CCCCCC" >
					<tr style="background:'.$setColor.'" onmouseOver="this.style.backgroundColor=\'#D7F2D2\'" onmouseOut="this.style.backgroundColor=\''.$setColor.'\'">
						<td width="56" align="center" valign="middle" class="small style1"><input type="checkbox" name="checkboxABN'.($i+1).'" value="'.$requestNo.'" id="checkboxesABN[]" /><img src="../images/'.$imageMail.'" border="0" /></td>
						<td width="191" align="center" valign="middle" class="small style1">'.$requestNo.'</td>
						<td width="151" align="center" valign="middle" class="small style1">'.$cartId.'</td>
						<td width="196" align="center" valign="middle" class="small style1">'.$requestor.'</td>
						<td width="160" align="center" valign="middle" class="small style1">'.$datePosted.'</td>
					  </tr>
			  	</table>
			  </div>
		  </a>';
		  }
		 }
		
		?>
	
	
	</div>
	
</div>

<div id="tcontent3" class="tabcontent" align="left">

  	<table width="714" border="0" cellpadding="0" cellspacing="1" bgcolor="#3399FF">
          <tr>
           <td width="56" align="center" valign="middle" bgcolor="#333333" class="Orange_font"><input type="checkbox" name="checkboxAllDIR" value="checkAllCheckedDIR" onclick="JavaScript: checkAllBoxDIR();" /></td>
            <td width="206" align="center" valign="middle" bgcolor="#333333" class="Orange_font"><strong>Request No</strong></td>
            <td width="155" align="center" valign="middle" bgcolor="#333333" class="Orange_font"><strong>Cart ID </strong></td>
            <td width="196" align="center" valign="middle" bgcolor="#333333" class="Orange_font"><strong>Requestor </strong></td>
            <td width="160" align="center" valign="middle" bgcolor="#333333" class="Orange_font"><strong>Date Posted</strong></td>
	  </tr>
	  </table>
  	<div style="height:200px;width:740px; overflow: auto;">
		<?php
		 
	  	//$sql_abn = 'Select * from dir where requestorFolder = 0 order by requestNo DESC';
		$result = mysql_query($sql_dir) or die(mysql_error());
		$num = mysql_num_rows($result);
		
		//cell color checker
		$colorPicker = 1;
		$setColor = '';
		$imageMail = '';
		
			if ($num > 0) {
				for($i=0; $i<$num; $i++) {
					$row = array();
					$row = mysql_fetch_array($result);
										
					$requestNo = $row['requestNo'];
					$cartId = $row['cartId'];
					$requestor = $row['requestor'];
					$datePosted = $row['datePosted'];
					
// note to change cell color you must declare color for style="background:#999999" & onmouseOut="this.style.backgroundColor=\'#999999\'"

// available colors are : gray = #999999, dark gray = #666666, light gray = #CCCCCC, beage = #FFCC66
// mail images 
/*	1 new mail = newMail.gif
	2 mail checked = mailChecked.gif
	3 responded = responded.gif

*/
					if($row['requestorCheck'] == 0 || $row['requestorCheck'] == 5){
						$setColor = '#FFCC66';
						$imageMail = 'newMail.gif';
					}elseif($row['requestorCheck'] == 1){
						$setColor = '#999999';
						$imageMail = 'mailChecked.gif';
					}elseif($row['requestorCheck'] == 2){
						$setColor = '#666666';
						$imageMail = 'responded.gif';
					}elseif($row['requestorCheck'] == 3){
						$setColor = '#99CC66';
						$imageMail = 'mailfolders.gif';
					}elseif($row['requestorCheck'] == 4){
						$setColor = '#FF6666';
						$imageMail = 'delete.gif';
					}
					
		echo '<a href="javascript:ajaxpage(\'ajaxfiles/external2.php?idInquiry='.$requestNo.'&idStatus='.$row['requestorCheck'].'\', \'rightcolumn\');" >
			<div style="height: auto;width:714px;"  >
				<table  width="714" cellpadding="1" cellspacing="1" border="0" bgColor="#CCCCCC" >
					<tr style="background:'.$setColor.'" onmouseOver="this.style.backgroundColor=\'#D7F2D2\'" onmouseOut="this.style.backgroundColor=\''.$setColor.'\'">
						<td width="56" align="center" valign="middle" class="small style1"><input type="checkbox" name="checkboxDIR'.($i+1).'" value="'.$requestNo.'" id="checkboxesDIR[]" /><img src="../images/'.$imageMail.'" border="0" /></td>
						<td width="191" align="center" valign="middle" class="small style1">'.$requestNo.'</td>
						<td width="151" align="center" valign="middle" class="small style1">'.$cartId.'</td>
						<td width="196" align="center" valign="middle" class="small style1">'.$requestor.'</td>
						<td width="160" align="center" valign="middle" class="small style1">'.$datePosted.'</td>
					  </tr>
			  	</table>
			  </div>
		  </a>';
		  }
		 }
		
		?>
	
	
	</div>
</div>

<div id="tcontent4" class="tabcontent" align="left">

  	<table width="714" border="0" cellpadding="0" cellspacing="1" bgcolor="#3399FF">
          <tr>
           <td width="63" align="center" valign="middle" bgcolor="#333333" class="Orange_font"><input type="checkbox" name="checkboxAllMIR" value="checkAllCheckedMIR" onclick="JavaScript: checkAllBoxMIR();" /></td>
            <td width="174" align="center" valign="middle" bgcolor="#333333" class="Orange_font"><strong>Request No</strong></td>
            <td width="162" align="center" valign="middle" bgcolor="#333333" class="Orange_font"><strong>Description </strong></td>
            <td width="162" align="center" valign="middle" bgcolor="#333333" class="Orange_font"><strong>Requestor </strong></td>
            <td width="147" align="center" valign="middle" bgcolor="#333333" class="Orange_font"><strong>Date Posted</strong></td>
	  </tr>
	  </table>
  	<div style="height:200px;width:740px; overflow: auto;">
		<?php
		 
	  //$sql_abn = 'Select * from mir where requestorFolder = 0 order by requestNo DESC';
		$result = mysql_query($sql_mir) or die(mysql_error());
		$num = mysql_num_rows($result);
		
		//cell color checker
		$colorPicker = 1;
		$setColor = '';
		$imageMail = '';
		
			if ($num > 0) {
				for($i=0; $i<$num; $i++) {
					$row = array();
					$row = mysql_fetch_array($result);
										
					$requestNo = $row['requestNo'];
					$description = $row['description'];
					$requestor = $row['requestor'];
					$datePosted = $row['datePosted'];
					
// note to change cell color you must declare color for style="background:#999999" & onmouseOut="this.style.backgroundColor=\'#999999\'"

// available colors are : gray = #999999, dark gray = #666666, light gray = #CCCCCC, beage = #FFCC66
// mail images 
/*	1 new mail = newMail.gif
	2 mail checked = mailChecked.gif
	3 responded = responded.gif

*/
					if($row['requestorCheck'] == 0 || $row['requestorCheck'] == 5){
						$setColor = '#FFCC66';
						$imageMail = 'newMail.gif';
					}elseif($row['requestorCheck'] == 1){
						$setColor = '#999999';
						$imageMail = 'mailChecked.gif';
					}elseif($row['requestorCheck'] == 2){
						$setColor = '#666666';
						$imageMail = 'responded.gif';
					}elseif($row['requestorCheck'] == 3){
						$setColor = '#99CC66';
						$imageMail = 'mailfolders.gif';
					}elseif($row['requestorCheck'] == 4){
						$setColor = '#FF6666';
						$imageMail = 'delete.gif';
					}
					
		echo '<a href="javascript:ajaxpage(\'ajaxfiles/external2.php?idInquiry='.$requestNo.'&idStatus='.$row['requestorCheck'].'\', \'rightcolumn\');" >
			<div style="height: auto;width:714px;"  >
				<table  width="714" cellpadding="1" cellspacing="1" border="0" bgColor="#CCCCCC" >
					<tr style="background:'.$setColor.'" onmouseOver="this.style.backgroundColor=\'#D7F2D2\'" onmouseOut="this.style.backgroundColor=\''.$setColor.'\'">
					  <td width="63" align="center" valign="middle" class="small style1"><input type="checkbox" name="checkboxMIR'.($i+1).'" value="'.$requestNo.'" id="checkboxesMIR[]" /><img src="../images/'.$imageMail.'" border="0" /></td>
						<td width="174" align="center" valign="middle" class="small style1">'.$requestNo.'</td>
						<td width="162" align="center" valign="middle" class="small style1">'.$description.'</td>
						<td width="162" align="center" valign="middle" class="small style1">'.$requestor.'</td>
						<td width="147" align="center" valign="middle" class="small style1">'.$datePosted.'</td>
				  </tr>
				</table>
			  </div>
		  </a>';
		  }
		 }
		
		?>
	
	
	</div>
</div>

<script type="text/javascript">
//Start Tab Content script for UL with id="maintab" Separate multiple ids each with a comma.
initializetabcontent("maintab")
</script>

</body>
</html>
