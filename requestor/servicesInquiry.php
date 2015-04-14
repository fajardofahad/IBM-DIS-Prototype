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
<link  href="../css/sddm.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="../css/tabcontent.css" />
<script language="javascript" type="text/javascript"  src="../javascript/calendarHandler.js"></script>
<script language="javascript" type="text/javascript">

function ServiceSubmit(){
//STANDARD FIELD VALUES
var BusinessJustification = document.forms['requestForm'].businessJustification.value;
var service = document.forms['requestForm'].cmbService.selectedIndex;
durationDate();
//START OF CHECKING REQUIRED FIELD CONTENT
if(BusinessJustification == ""){

	alert("Business Justification must have a value.");
	document.forms['requestForm'].businessJustification.focus();
	
}else if(service == 0){
		alert("Please Select Nature of Service.");	
		document.forms['requestForm'].cmbService.focus();
		
}else{
	document.forms['requestForm'].action = "../dbInsert/insertServicesInquiry.php";
	document.forms['requestForm'].submit();
	
}

}

function durationDate(){
var dateStart = document.forms['requestForm'].dateStart.value
		var dateEnd = document.forms['requestForm'].dateEnd.value

		var startYear = dateStart.substring(0,4);
		var startMonth = dateStart.substring(5,7);
		var startDay = dateStart.substring(8,10);
		
		var endYear = dateEnd.substring(0,4);
		var endMonth = dateEnd.substring(5,7);
		var endDay = dateEnd.substring(8,10);	
	// script for date checker
		if(document.forms['requestForm'].dateStart.value!="" && document.forms['requestForm'].dateEnd.value!=""){
		
		

			if(startYear>endYear){
					alert("Date End Must be ahead of Date Start");
					exit();
				
			}else if(startMonth>endMonth){
				if(startYear>=endYear){
					alert("Date End Must be ahead of Date Start");
					exit();
				}
			}else if(startMonth==endMonth && startYear==endYear){
				if(startDay>endDay){
					alert("Date End Must be ahead of Date Start");
					exit();
				}
			}
		}else if(document.forms['requestForm'].dateStart.value=="" || document.forms['requestForm'].dateEnd.value==""){
			alert("Duration date must be filled.");
			exit();
		}
		
}
</script>
</head>
<body>
<form  method="post" name="requestForm" enctype="multipart/form-data">
<table width="976">
<tr><td colspan="2"><img src="../images/Header.gif" width="900" height="175" /></td></tr>
<tr><td colspan="2" align="right" background="../images/nav.jpg"></td></tr>
<tr><td width="202" valign="top" >
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
<td width="762" align="center" valign="top">
  <!-- *********************************START CENTER MENU****************************** -->
<div align="left" style="float:right;height:20px;width:40px"><img align="right" src="../images/inquiries.JPG"/></div>
	<br /><br /><a href="newInquiries.php" ><img src="../images/prevArrorw.gif" align="left" border="0"/><br />
	<div align="left" class="colorwhite">
	<b>Back to New Inquiries</b></div>
	<br /><br />
	</a>
	<div  align="left" style="float:left;width:250px"><strong>
	  Service Request</strong></div>
	<br /><br /><br /><br />
	<div align="justify" style="float:left;height:10px;width:775px">Fields with asterisk (*) are required fields. </div>
	<div align="justify" style="float:left;height:10px;width:775px"></div>
	<div  align="justify" style="float: left;height: auto;width:775px;background-color:#7289D5; " >	 
		  <div style="float:left;width:165px">* Business Justification :&nbsp;&nbsp;</div>
		  <div style="float:left;width:165px">
		  <textarea name="businessJustification" cols="40" rows="5" id="noOfItems"></textarea>
		  </div>
	</div>
	<div align="justify" style="float:left;height:10px;width:775px"></div>
	<div align="justify" style="float:left;height:10px;width:775px"></div>
	<div align="justify" style="float:left;height:10px;width:775px">
	* Nature of Service needed :
	  <select name="cmbService" id="cmbService" >
        <option value="-" selected="selected">-Select Item-</option>
		<?php
								$sql_cmbNature = 'Select * from nature_of_services';
								$result = mysql_query($sql_cmbNature) or die(mysql_error());
								$num = mysql_num_rows($result);

								if ($num > 0) {
									for($i=0; $i<$num; $i++) {
										$row = array();
										$row = mysql_fetch_array($result);
										echo '<option value="'.$row['categoryValue'].'">'.$row['categoryValue'].'</option>';
									}
								}
							?>
	</select>
	</div>
	<div align="justify" style="float:left;height:10px;width:775px"></div>
	<div align="justify" style="float:left;height:10px;width:775px"></div>
	<div align="justify" style="float:left;height:10px;width:775px">Duration : </div>
	<div align="justify" style="float:left;height:10px;width:775px"></div
	><div align="justify" style="float:left;height:30px;width:775px">
	<div  align="right" style="float:left;width:165px;height:10px;">* Date Start :&nbsp;&nbsp;</div>
				<div  align="left" style="float:left;width:165px;height:10px;"><?php					
			
					if(isset($_GET["dateStart"])){
						$DateStart = $_GET["dateStart"];
						
					} else {
						$DateStart = "";
					}
			?>
				  <input type="text" align="middle" class="style3" name="dateStart" value="<?php echo $DateStart; ?>" onfocus="clearValue('dateStart');" readonly="true" size="10" />
				  <a href="JavaScript:cal1.popup();" onclick="clearValue('dateStart');',' calendarChecker();"><img src="../images/calendar/cal.gif" width="19" height="19" border="0" alt="Click this to select the start date of this event." /></a>
				  <script language="JavaScript" type="text/javascript">
							var cal1 = new calendar1(document.forms['requestForm'].elements['dateStart']);
							cal1.year_scroll = true;
							cal1.time_comp = false;
									  </script>
			</div>	
	</div>
	<div align="justify" style="float:left;height:10px;width:775px"></div>
	<div align="justify" style="float:left;height:30px;width:775px">
	<div  align="right" style="float:left;width:165px;height:10px;">* Date End :&nbsp;&nbsp;</div>
				<div  align="left" style="float:left;width:165px;height:10px;"><?php					
			
					if(isset($_GET["dateEnd"])){
						$DateEnd = $_GET["dateEnd"];
						
					} else {
						$DateEnd = "";
					}
			?>
				  <input type="text" align="middle" class="style3" name="dateEnd" value="<?php echo $DateEnd; ?>" onfocus="clearValue('dateEnd');" readonly="true" size="10" />
				  <a href="JavaScript:cal2.popup();" onclick="clearValue('dateEnd');',' calendarChecker();"><img src="../images/calendar/cal.gif" width="19" height="19" border="0" alt="Click this to select the start date of this event." /></a>
				  <script language="JavaScript" type="text/javascript">
							var cal2 = new calendar1(document.forms['requestForm'].elements['dateEnd']);
							cal2.year_scroll = true;
							cal2.time_comp = false;
									  </script>
			</div>	
	</div>
	<div align="justify" style="float:left;height:10px;width:775px"></div>
	<div align="justify" style="float:left;height:10px;width:775px;background-color:#7289D5"> 
	<div  align="right" style="float:left;width:310px">Suggested Supplier :&nbsp;
	  <input type="text" name="suggestedSupplier" /> 
	  &nbsp;</div>
		<input name="Clear" type="reset" id="Clear" value="Clear Form" />
		  <input type="button" name="Submit" value="Submit" onclick="JavaScript: ServiceSubmit();" />
	</div>
	<div align="justify" style="float:left;height:20px;width:775px"></div>
	<div align="justify" style="float:left;height:20px;width:775px"></div>
	<div align="justify" style="float:left;height:20px;width:775px">Attachments : </div>
	<div align="justify" style="float:left;height:20px;width:775px"><input type="hidden" name="MAX_FILE_SIZE1" value="2000000"><input type="file" name="attachment1" />
	  <br />
	  <input type="hidden" name="MAX_FILE_SIZE2" value="2000000">
	  <input type="file" name="attachment2" />
	  <div align="justify" style="float:left;height:20px;width:775px"></div>
	  <div align="justify" style="float:left;height:20px;width:775px"></div>
	</div>
	
  <!-- *********************************END CENTER MENU****************************** -->
    
</td>
</tr></table>
</form>
</body>
</html>
