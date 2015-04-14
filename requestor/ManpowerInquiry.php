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

function ClearSpecialCatalog(){
	
	document.forms['requestForm'].txtSpecialCatalog.readOnly = true;
	document.forms['requestForm'].txtSpecialCatalog.value = "";
	
}

function ClearContractCatalog(){
	document.forms['requestForm'].txtSpecialCatalog.readOnly = false;
	document.forms['requestForm'].cmbContractCatalog.selectedIndex=0;
	
}

function ClearSpecialCatalog2(w){
	var x=w-1;
	//alert(x);
	document.forms['requestForm'].elements['txtSpecialCatalogID[]'][x].readOnly = true;
	document.forms['requestForm'].elements['txtSpecialCatalogID[]'][x].value = "";
	
}

function ClearContractCatalog2(w){
	var x=w-1;
	//alert(x);
	document.forms['requestForm'].elements['txtSpecialCatalogID[]'][x].readOnly = false;
	document.forms['requestForm'].elements['cmbContractCatalogID[]'][x].selectedIndex=0;
	
}

function durationDate2(z){

		var x=z;
		var dateStart = document.forms['requestForm'].elements['dateStartID[]'][x].value
		var dateEnd = document.forms['requestForm'].elements['dateEndID[]'][x].value

		var startYear = dateStart.substring(0,4);
		var startMonth = dateStart.substring(5,7);
		var startDay = dateStart.substring(8,10);
		
		var endYear = dateEnd.substring(0,4);
		var endMonth = dateEnd.substring(5,7);
		var endDay = dateEnd.substring(8,10);	
	// script for date checker
		if(document.forms['requestForm'].elements['dateStartID[]'][x].value!="" && document.forms['requestForm'].elements['dateEndID[]'][x].value!=""){
		
		

			if(startYear>endYear){
					alert("Date End Must be ahead of Date Start in Item "+(x+1)+".");
					exit();
				
			}else if(startMonth>endMonth){
				if(startYear>=endYear){
					alert("Date End Must be ahead of Date Start in Item "+(x+1)+".");
					exit();
				}
			}else if(startMonth==endMonth && startYear==endYear){
				if(startDay>endDay){
					alert("Date End Must be ahead of Date Start in Item "+(x+1)+".");
					exit();
				}
			}
		}else if(document.forms['requestForm'].elements['dateStartID[]'][x].value=="" || document.forms['requestForm'].elements['dateEndID[]'][x].value==""){
			alert("Duration date must be filled in Item "+(x+1)+".");
			exit();
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

function ManpowerSubmit(){
//STANDARD FIELD VALUES
var BusinessJustification = document.forms['requestForm'].businessJustification.value;
var NoOfItems = document.forms['requestForm'].ItemNo.value;

//alert(NoOfItems);

//START OF CHECKING REQUIRED FIELD CONTENT
if(BusinessJustification == ""){

	alert("Business Justification must have a value.");
	document.forms['requestForm'].businessJustification.focus();
	
}else if(NoOfItems < 1){

	alert("No of items must be atleast 1 or greater.");
	document.forms['requestForm'].noOfItems.focus();
	
}else if(NoOfItems == 1){

	//GET FIELD VALUES IF NO OF ITEM IS 1 AND NOT GREATER THAN 1
	var CmbContractCatalog = document.forms['requestForm'].cmbContractCatalog.selectedIndex;
	var TxtSpecialCatalog = document.forms['requestForm'].txtSpecialCatalog.value;
	var ContractorName = document.forms['requestForm'].contractorName.value;
	var Vendor = document.forms['requestForm'].vendor.value;
	var Designation = document.forms['requestForm'].designation.value;
	var Department = document.forms['requestForm'].department.value;
	var ImmediateSupervisor = document.forms['requestForm'].immediateSupervisor.value;
	var Attachment = document.forms['requestForm'].attachment1.value;
	
	if(CmbContractCatalog == 0 && TxtSpecialCatalog == ""){
		alert("Please fill-up either Contract Catalog or Special Catalog.");
		exit();
	}else if(ContractorName == ""){
		alert("Contractor Name field must have a value.");
		document.forms['requestForm'].contractorName.focus();
		exit();
	}else if(Vendor == ""){
		alert("Vendor Name field must have a value.");
		document.forms['requestForm'].vendor.focus();
		exit();
	}else if(Designation == ""){
		alert("Designation field must have a value.");
		document.forms['requestForm'].designation.focus();
		exit();
	}else if(Department == ""){
		alert("Department field must have a value.");
		document.forms['requestForm'].department.focus();
		exit();
	}else if(ImmediateSupervisor == ""){
		alert("ImmediateSupervisor field must have a value.");
		document.forms['requestForm'].immediateSupervisor.focus();
		exit();
	}else if(Attachment == ""){
		alert("Please have atleast one (1) attachment.");
		document.forms['requestForm'].attachment1.focus();
		exit();
	}
durationDate();
	document.forms['requestForm'].action = "../dbInsert/insertManpowerInquiry.php";
	document.forms['requestForm'].submit();
	
}else if(NoOfItems > 1){

	for(z=0;z<NoOfItems;z++){
		
		if(document.forms['requestForm'].elements['cmbContractCatalogID[]'][z].selectedIndex == 0 && document.forms['requestForm'].elements['txtSpecialCatalogID[]'][z].value == ""){
			alert("Please fill-up either Contract Catalog or Special Catalog in Item "+(z+1)+".");
			exit();
		}else if(document.forms['requestForm'].elements['contractorNameID[]'][z].value == ""){
			alert("Contractor Name field in Item "+(z+1)+" must have a value.");
			document.forms['requestForm'].elements['contractorNameID[]'][z].focus();
			exit();
		}else if(document.forms['requestForm'].elements['vendorID[]'][z].value == ""){
			alert("Vendor Name field in Item "+(z+1)+" must have a value.");
			document.forms['requestForm'].elements['vendorID[]'][z].focus();
			exit();
		}else if(document.forms['requestForm'].elements['designationID[]'][z].value == ""){
			alert("Designation field in Item "+(z+1)+" must have a value.");
			document.forms['requestForm'].elements['designationID[]'][z].focus();
			exit();
		}else if(document.forms['requestForm'].elements['departmentID[]'][z].value == ""){
			alert("Department field in Item "+(z+1)+" must have a value.");
			document.forms['requestForm'].elements['departmentID[]'][z].focus();
			exit();
		}else if(document.forms['requestForm'].elements['immediateSupervisorID[]'][z].value == ""){
			alert("ImmediateSupervisor field in Item "+(z+1)+" must have a value.");
			document.forms['requestForm'].elements['immediateSupervisorID[]'][z].focus();
			exit();
		}else if(document.forms['requestForm'].elements['attachment1ID[]'][z].value == ""){
			alert("Please have atleast one (1) attachment in Item "+(z+1)+".");
			document.forms['requestForm'].elements['attachment1ID[]'][z].focus();
			exit();
		}
		
		durationDate2(z);
	
	}
	
	document.forms['requestForm'].action = "../dbInsert/insertManpowerInquiry.php";
	document.forms['requestForm'].submit();
	
}


//alert(" " + itemsLength);
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
	  Manpower Request</strong></div>
	<br /><br /><br /><br />
	<div align="justify" style="float:left;height:10px;width:775px">Fields with asterisk (*) are required fields. </div>
	<div align="justify" style="float:left;height:10px;width:775px"></div>
	<div  align="justify" style="float:left;height: auto;width:775px;background-color:#7289D5; " >	 
		  <div style="float:left;width:165px">* Business Justification :&nbsp;&nbsp;</div>
		  <div style="float:left;width:165px">
		  <textarea name="businessJustification" cols="40" rows="5" id="noOfItems"></textarea>
		  </div>
	</div>
	<div align="justify" style="float:left;height:10px;width:775px"></div>
	<div align="justify" style="float:left;height:10px;width:775px"></div>
	<div align="justify" style="float:left;height:10px;width:775px;background-color:#7289D5"> 
	<div  align="right" style="float:left;width:165px">* No. of items :&nbsp;&nbsp;</div>
		<?php
		  if(isset($_POST['noOfItems'])){
		 		echo '<input name="noOfItems" type="text" id="noOfItems" size="2" maxlength="2" value="'.$_POST['noOfItems'].'" /><input name="ItemNo" type="hidden" id="ItemNo" value="'.$_POST['noOfItems'].'"/>';
			}elseif(!(isset($_POST['noOfItems']))){
				echo '<input name="noOfItems" type="text" id="noOfItems" size="2" maxlength="2" value="1"/><input name="ItemNo" type="hidden" id="ItemNo" value="1"/>';
			}
		  ?>
		  <input name="Change" type="submit" id="Change" value="Change" />
		  <input name="Clear" type="reset" id="Clear" value="Clear Form" />
		  <input type="button" name="Submit" value="Submit" onclick="JavaScript: ManpowerSubmit();" />
	</div>
	<div align="justify" style="float:left;height:20px;width:775px"></div>
	
	<div align="center" style="float:left;height:320px;width:775px;overflow:auto; background-color:#96A9E4" >
		
		
			<?php
				if(!(isset($_POST['noOfItems'])) || $_POST['noOfItems'] == 1 ){
		 			echo '<br />
						<div align="justify" style="height:300px;width:760px;background-color:#666666;">
						<div align="left" style="float:left;height:5px;width:760px;">Item 1</div>
						<div align="left" style="float:left;height:20px;width:760px;"></div>
						<div align="left" style="float:left;height:20px;width:760px;">&nbsp;&nbsp;&nbsp;<strong>Choose type of catalog  request </strong>( choose either &quot;<strong>Contract Catalog</strong>&quot; or &quot;<strong>Special Catalog</strong>&quot; )</div>
						<div align="left" style="float:left;height:10px;width:760px;"></div>
						<div align="right" style="float:left;height:20px;width:100px;">* Contract&nbsp;&nbsp; Catalog:&nbsp;&nbsp;</div>
						<div align="left" style="float:left;height:20px;width:145px;"><span class="redMarks">
						  <select name="cmbContractCatalog" class="style3" id="cmbContractCatalog"  onfocus="JavaScript: ClearSpecialCatalog();">
                            <option value="-" selected="selected">-Select Item-</option>';
								$sql_cmbContractCatalog = 'Select * from contract_catalog';
								$result = mysql_query($sql_cmbContractCatalog) or die(mysql_error());
								$num = mysql_num_rows($result);

								if ($num > 0) {
									for($i=0; $i<$num; $i++) {
										$row = array();
										$row = mysql_fetch_array($result);
										echo '<option value="'.$row['contractValue'].'" >'.$row['contractValue'].'</option>';
									}
								}
                         echo ' </select>
						</span></div>
						<div align="right" style="float:left;height:20px;width:100px;">* Special&nbsp;&nbsp; Catalog:&nbsp;&nbsp;</div>
						<div align="left" style="float:left;height:70px;width:145px;"><span class="style3">
						  <textarea name="txtSpecialCatalog" cols="18" rows="3" id="txtSpecialCatalog" onfocus="JavaScript: ClearContractCatalog();"></textarea>
						</span></div>
						<div align="right" style="float:left;height:20px;width:100px;">* Contractor&nbsp;&nbsp; Name  :&nbsp;&nbsp;</div>
						<div align="left" style="float:left;height:20px;width:145px;"><input type="text" name="contractorName" /></div>
						<div align="left" style="float:left;height:5px;width:760px;"></div>
						<div align="right" style="float:left;height:20px;width:100px;">*Vendor&nbsp; &nbsp;<br />
						   Name  :&nbsp;&nbsp;</div>
						<div align="left" style="float:left;height:20px;width:145px;"><input type="text" name="vendor" /></div>
						<div align="right" style="float:left;height:20px;width:100px;">*Designation :&nbsp;&nbsp;</div>
						<div align="left" style="float:left;height:20px;width:145px;"><input type="text" name="designation" /></div>
						<div align="right" style="float:left;height:20px;width:100px;">*Department  :&nbsp;&nbsp;</div>
						<div align="left" style="float:left;height:20px;width:145px;"><input type="text" name="department" /></div>
						<div align="left" style="float:left;height:15px;width:760px;"></div>
						<div align="right" style="float:left;height:20px;width:100px;">* Immediate&nbsp;&nbsp; Supervisor  :&nbsp;&nbsp;</div>
						<div align="left" style="float:left;height:20px;width:145px;"><input type="text" name="immediateSupervisor" /></div>
						<div align="right" style="float:left;height:20px;width:100px;">* Date Start  : </div>
						<div align="left" style="float:left;height:20px;width:145px;">
						
					
				  <input type="text" align="middle" name="dateStart" onfocus="clearValue(\'dateStart\');" readonly="true" size="10" />
				  <a href="JavaScript:cal1.popup();" onclick="clearValue(\'dateStart\');',' calendarChecker();"><img src="../images/calendar/cal.gif" width="19" height="19" border="0" alt="Click this to select the start date of this event." /></a>
				  <script language="JavaScript" type="text/javascript">
							var cal1 = new calendar1(document.forms[\'requestForm\'].elements[\'dateStart\']);
							cal1.year_scroll = true;
							cal1.time_comp = false;
									  </script>
						
						</div>
						<div align="right" style="float:left;height:20px;width:100px;">* Date End : &nbsp;</div>
						<div align="left" style="float:left;height:20px;width:145px;">
						
				  <input type="text" align="middle" name="dateEnd" onfocus="clearValue(\'dateEnd\');" readonly="true" size="10" />
				  <a href="JavaScript:cal2.popup();" onclick="clearValue(\'dateEnd\');',' calendarChecker();"><img src="../images/calendar/cal.gif" width="19" height="19" border="0" alt="Click this to select the start date of this event." /></a>
				  <script language="JavaScript" type="text/javascript">
							var cal2 = new calendar1(document.forms[\'requestForm\'].elements[\'dateEnd\']);
							cal2.year_scroll = true;
							cal2.time_comp = false;
									  </script>
						
						</div>
						<div align="left" style="float:left;height:20px;width:760px;"></div>
						<div align="right" style="float:left;height:20px;width:100px;">Others :&nbsp;&nbsp;</div>
						<div align="left" style="float:left;height:20px;width:145px;">
						  <textarea name="others" rows="4"></textarea>
						</div>
						<div align="right" style="float:left;height:20px;width:130px;"> * Attachment :&nbsp;&nbsp;</div>
						<div align="left" style="float:left;height:20px;width:145px;"><input type="hidden" name="MAX_FILE_SIZE1" value="2000000"><input type="file" name="attachment1" /><input type="hidden" name="MAX_FILE_SIZE2" value="2000000">
						  <input type="file" name="attachment2" /></div>
			  			</div>
						  ';
				}elseif(isset($_POST['noOfItems']) && $_POST['noOfItems'] != 1){
					$noOfItems = $_POST['noOfItems'];
					
					for($i=1;$i<=$noOfItems;$i++){
					echo '<br />
						<div align="justify" style="height:300px;width:760px;background-color:#666666;">
						<div align="left" style="float:left;height:5px;width:760px;">Item '.$i.'</div>
						<div align="left" style="float:left;height:20px;width:760px;"></div>
						<div align="left" style="float:left;height:20px;width:760px;">&nbsp;&nbsp;&nbsp;<strong>Choose type of catalog  request </strong>( choose either &quot;<strong>Contract Catalog</strong>&quot; or &quot;<strong>Special Catalog</strong>&quot; )</div>
						<div align="left" style="float:left;height:10px;width:760px;"></div>
						<div align="right" style="float:left;height:20px;width:100px;">* Contract&nbsp;&nbsp; Catalog:&nbsp;&nbsp;</div>
						<div align="left" style="float:left;height:20px;width:145px;"><span class="redMarks">
						  <select name="cmbContractCatalog'.$i.'" class="style3" id="cmbContractCatalogID[]"  onfocus="JavaScript: ClearSpecialCatalog2(\''.$i.'\');">
                            <option value="-" selected="selected">-Select Item-</option>';
								$sql_cmbContractCatalog = 'Select * from contract_catalog';
								$result = mysql_query($sql_cmbContractCatalog) or die(mysql_error());
								$num = mysql_num_rows($result);

								if ($num > 0) {
									for($w=0; $w<$num; $w++) {
										$row = array();
										$row = mysql_fetch_array($result);
										echo '<option value="'.$row['contractValue'].'" >'.$row['contractValue'].'</option>';
									}
								}
                         echo ' </select>
						</span></div>
						<div align="right" style="float:left;height:20px;width:100px;">* Special&nbsp;&nbsp; Catalog:&nbsp;&nbsp;</div>
						<div align="left" style="float:left;height:70px;width:145px;"><span class="style3">
						  <textarea name="txtSpecialCatalog'.$i.'" cols="18" rows="3" id="txtSpecialCatalogID[]" onfocus="JavaScript: ClearContractCatalog2(\''.$i.'\');"></textarea>
						</span></div>
						<div align="right" style="float:left;height:20px;width:100px;">* Contractor&nbsp;&nbsp; Name  :&nbsp;&nbsp;</div>
						<div align="left" style="float:left;height:20px;width:145px;"><input type="text" name="contractorName'.$i.'" id="contractorNameID[]" /></div>
						<div align="left" style="float:left;height:5px;width:760px;"></div>
						<div align="right" style="float:left;height:20px;width:100px;">*Vendor&nbsp; &nbsp;<br />
						   Name  :&nbsp;&nbsp;</div>
						<div align="left" style="float:left;height:20px;width:145px;"><input type="text" name="vendor'.$i.'" id="vendorID[]" /></div>
						<div align="right" style="float:left;height:20px;width:100px;">*Designation :&nbsp;&nbsp;</div>
						<div align="left" style="float:left;height:20px;width:145px;"><input type="text" name="designation'.$i.'" id="designationID[]" /></div>
						<div align="right" style="float:left;height:20px;width:100px;">*Department  :&nbsp;&nbsp;</div>
						<div align="left" style="float:left;height:20px;width:145px;"><input type="text" name="department'.$i.'" id="departmentID[]" /></div>
						<div align="left" style="float:left;height:15px;width:760px;"></div>
						<div align="right" style="float:left;height:20px;width:100px;">* Immediate&nbsp;&nbsp; Supervisor  :&nbsp;&nbsp;</div>
						<div align="left" style="float:left;height:20px;width:145px;"><input type="text" name="immediateSupervisor'.$i.'" id="immediateSupervisorID[]" /></div>
						<div align="right" style="float:left;height:20px;width:100px;">* Date Start  : </div>
						<div align="left" style="float:left;height:20px;width:145px;">
						
					
				  <input type="text" align="middle" id="dateStartID[]" name="dateStart'.$i.'" onfocus="clearValue(\'dateStart'.$i.'\');" readonly="true" size="10" />
				  <a href="JavaScript:cal1'.$i.'.popup();" onclick="clearValue(\'dateStart'.$i.'\');',' calendarChecker();"><img src="../images/calendar/cal.gif" width="19" height="19" border="0" alt="Click this to select the start date of this event." /></a>
				  <script language="JavaScript" type="text/javascript">
							var cal1'.$i.' = new calendar1(document.forms[\'requestForm\'].elements[\'dateStart'.$i.'\']);
							cal1'.$i.'.year_scroll = true;
							cal1'.$i.'.time_comp = false;
									  </script>
						
						</div>
						<div align="right" style="float:left;height:20px;width:100px;">* Date End : &nbsp;</div>
						<div align="left" style="float:left;height:20px;width:145px;">
						
				  <input type="text" align="middle" id="dateEndID[]" name="dateEnd'.$i.'" onfocus="clearValue(\'dateEnd'.$i.'\');" readonly="true" size="10" />
				  <a href="JavaScript:cal2'.$i.'.popup();" onclick="clearValue(\'dateEnd'.$i.'\');',' calendarChecker();"><img src="../images/calendar/cal.gif" width="19" height="19" border="0" alt="Click this to select the start date of this event." /></a>
				  <script language="JavaScript" type="text/javascript">
							var cal2'.$i.' = new calendar1(document.forms[\'requestForm\'].elements[\'dateEnd'.$i.'\']);
							cal2'.$i.'.year_scroll = true;
							cal2'.$i.'.time_comp = false;
									  </script>
						
						</div>
						<div align="left" style="float:left;height:20px;width:760px;"></div>
						<div align="right" style="float:left;height:20px;width:100px;">Others :&nbsp;&nbsp;</div>
						<div align="left" style="float:left;height:20px;width:145px;">
						  <textarea name="others'.$i.'" rows="4" id=""></textarea>
						</div>
						<div align="right" style="float:left;height:20px;width:130px;"> * Attachment :&nbsp;&nbsp;</div>
						<div align="left" style="float:left;height:20px;width:145px;"><input type="hidden" name="MAX_FILE_SIZE1'.$i.'" id="MAX_FILE_SIZE1ID[]" value="2000000"><input type="file" name="attachment1'.$i.'" id="attachment1ID[]" /><input type="hidden" name="MAX_FILE_SIZE2'.$i.'" id="MAX_FILE_SIZE2ID[]" value="2000000">
						  <input type="file" name="attachment2'.$i.'" id="attachment2ID[]" /></div>
			  			</div>
						  ';
			  		}
				}
			?>
	</div>
  <!-- *********************************END CENTER MENU****************************** --></td>
</tr></table>
</form>
</body>
</html>
