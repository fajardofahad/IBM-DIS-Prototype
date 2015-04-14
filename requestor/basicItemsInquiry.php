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

function BasicItemSubmit(){
//STANDARD FIELD VALUES
var BusinessJustification = document.forms['requestForm'].businessJustification.value;
var DateNeeded = document.forms['requestForm'].dateNeeded.value;
var NoOfItems = document.forms['requestForm'].ItemNo.value;
//alert(NoOfItems);

//START OF CHECKING REQUIRED FIELD CONTENT
if(BusinessJustification == ""){

	alert("Business Justification must have a value.");
	document.forms['requestForm'].businessJustification.focus();
	
}else if(DateNeeded == "" ){

	alert("Date Needed must have a value.");
	document.forms['requestForm'].dateNeeded.focus();
	
}else if(NoOfItems < 1){

	alert("No of items must be atleast 1 or greater.");
	document.forms['requestForm'].noOfItems.focus();
	
}else if(NoOfItems == 1){

	//GET FIELD VALUES IF NO OF ITEM IS 1 AND NOT GREATER THAN 1
	var Items = document.forms['requestForm'].items.value;
	var Quantity = document.forms['requestForm'].quantity.value;
	
	if(Items == ""){
		alert("Item field must have a value.");
		document.forms['requestForm'].items.focus();
		exit();
	}else if(Quantity == ""){
		alert("Quantity field must have a value.");
		document.forms['requestForm'].quantity.focus();
		exit();
	}

	document.forms['requestForm'].action = "../dbInsert/insertBasicItemsInquiry.php";
	document.forms['requestForm'].submit();
	
}else if(NoOfItems > 1){

	for(z=0;z<NoOfItems;z++){
		
		if(document.forms['requestForm'].elements['itemID[]'][z].value == ""){
			alert("Item in Item "+(z+1)+" must have a value.");
			document.forms['requestForm'].elements['itemID[]'][z].focus();
			
			exit();
		}else if(document.forms['requestForm'].elements['quantityID[]'][z].value == ""){
			alert("Quantity in Item "+(z+1)+" must have a value.");
			document.forms['requestForm'].elements['quantityID[]'][z].focus();
			
			exit();
		}
	}
	
	document.forms['requestForm'].action = "../dbInsert/insertBasicItemsInquiry.php";
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
	</a><a href="newInquiries.php" >
	<div align="left" class="colorwhite"> <b>Back to New Inquiries</b></div>
	</a><a href="newInquiries.php" ><br />
	<br />
	</a>
	<div  align="left" style="float:left;width:250px"><strong>
	  Basic Item
	  Request</strong></div>
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
	<div align="justify" style="float:left;height:30px;width:775px">
	<div  align="right" style="float:left;width:165px;height:10px;">* Date Needed :&nbsp;&nbsp;</div>
				<div  align="left" style="float:left;width:165px;height:10px;"><?php					
			
					if(isset($_GET["dateNeeded"])){
						$DateNeeded = $_GET["dateNeeded"];
						
					} else {
						$DateNeeded = "";
					}
			?>
				  <input type="text" align="middle" class="style3" name="dateNeeded" value="<?php echo $DateNeeded; ?>" onfocus="clearValue('dateNeeded');" readonly="true" size="10" />
				  <a href="JavaScript:cal1.popup();" onclick="clearValue('dateNeeded');',' calendarChecker();"><img src="../images/calendar/cal.gif" width="19" height="19" border="0" alt="Click this to select the start date of this event." /></a>
				  <script language="JavaScript" type="text/javascript">
							var cal1 = new calendar1(document.forms['requestForm'].elements['dateNeeded']);
							cal1.year_scroll = true;
							cal1.time_comp = false;
									  </script>
			</div>	
	</div>
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
		  <input type="button" name="Submit" value="Submit" onclick="JavaScript: BasicItemSubmit();" />
	</div>
	<div align="justify" style="float:left;height:20px;width:775px"></div>
	
	<div align="center" style="float:left;height:220px;width:775px;overflow:auto; background-color:#96A9E4" >
		
		
			<?php
				if(!(isset($_POST['noOfItems'])) || $_POST['noOfItems'] == 1 ){
		 			echo '<br />
						<div align="justify" style="height:195px;width:760px;background-color:#666666;">
						<div align="left" style="float:left;height:5px;width:760px;">Item 1</div>
						<div align="left" style="float:left;height:20px;width:760px;"></div>
						<div align="right" style="float:left;height:20px;width:100px;">* Item :&nbsp;&nbsp;</div>
						<div align="left" style="float:left;height:20px;width:145px;"><input type="text" name="items" /></div>
						<div align="right" style="float:left;height:20px;width:100px;">* Quantity :&nbsp;&nbsp;</div>
						<div align="left" style="float:left;height:20px;width:145px;"><input type="text" name="quantity" /></div>
						<div align="right" style="float:left;height:20px;width:100px;">Size :&nbsp;&nbsp;</div>
						<div align="left" style="float:left;height:20px;width:145px;"><input type="text" name="size" /></div>
						<div align="left" style="float:left;height:5px;width:760px;"></div>
						<div align="right" style="float:left;height:20px;width:100px;">Color :&nbsp;&nbsp;</div>
						<div align="left" style="float:left;height:20px;width:145px;"><input type="text" name="color" /></div>
						<div align="right" style="float:left;height:20px;width:100px;">Material :&nbsp;&nbsp;</div>
						<div align="left" style="float:left;height:20px;width:145px;"><input type="text" name="material" /></div>
						<div align="right" style="float:left;height:20px;width:100px;">Features / Options :&nbsp;&nbsp;</div>
						<div align="left" style="float:left;height:20px;width:145px;"><input type="text" name="features" /></div>
						<div align="left" style="float:left;height:15px;width:760px;"></div>
						<div align="right" style="float:left;height:20px;width:100px;">Brand :&nbsp;&nbsp;</div>
						<div align="left" style="float:left;height:20px;width:145px;"><input type="text" name="brand" /></div>
						<div align="right" style="float:left;height:20px;width:100px;">Model No. :&nbsp;&nbsp;</div>
						<div align="left" style="float:left;height:20px;width:145px;"><input type="text" name="modelNo" /></div>
						<div align="right" style="float:left;height:20px;width:100px;">Part No. :&nbsp;&nbsp;</div>
						<div align="left" style="float:left;height:20px;width:145px;"><input type="text" name="partNo" /></div>
						<div align="left" style="float:left;height:5px;width:760px;"></div>
						<div align="right" style="float:left;height:20px;width:100px;">Others :&nbsp;&nbsp;</div>
						<div align="left" style="float:left;height:20px;width:145px;">
						  <textarea name="others" rows="4"></textarea>
						</div>
						<div align="right" style="float:left;height:20px;width:130px;"> Attachment :&nbsp;&nbsp;</div>
						<div align="left" style="float:left;height:20px;width:145px;"><input type="hidden" name="MAX_FILE_SIZE1" value="2000000"><input type="file" name="attachment1" /><input type="hidden" name="MAX_FILE_SIZE2" value="2000000">
						  <input type="file" name="attachment2" /></div>
			  			</div>
						  ';
				}elseif(isset($_POST['noOfItems']) && $_POST['noOfItems'] != 1){
					$noOfItems = $_POST['noOfItems'];
					
					for($i=1;$i<=$noOfItems;$i++){
					echo '<br />
						<div align="justify" style="height:195px;width:760px;background-color:#666666;">
						<div align="left" style="float:left;height:5px;width:760px;">Item '.$i.'</div>
						<div align="left" style="float:left;height:20px;width:760px;"></div>
						<div align="right" style="float:left;height:20px;width:100px;">* Item :&nbsp;&nbsp;</div>
						<div align="left" style="float:left;height:20px;width:145px;"><input type="text" name="items'.$i.'" id="itemID[]" /></div>
						<div align="right" style="float:left;height:20px;width:100px;">* Quantity :&nbsp;&nbsp;</div>
						<div align="left" style="float:left;height:20px;width:145px;"><input type="text" name="quantity'.$i.'" id="quantityID[]" /></div>
						<div align="right" style="float:left;height:20px;width:100px;">Size :&nbsp;&nbsp;</div>
						<div align="left" style="float:left;height:20px;width:145px;"><input type="text" name="size'.$i.'" /></div>
						<div align="left" style="float:left;height:5px;width:760px;"></div>
						<div align="right" style="float:left;height:20px;width:100px;">Color :&nbsp;&nbsp;</div>
						<div align="left" style="float:left;height:20px;width:145px;"><input type="text" name="color'.$i.'" /></div>
						<div align="right" style="float:left;height:20px;width:100px;">Material :&nbsp;&nbsp;</div>
						<div align="left" style="float:left;height:20px;width:145px;"><input type="text" name="material'.$i.'" /></div>
						<div align="right" style="float:left;height:20px;width:100px;">Features / Options :&nbsp;&nbsp;</div>
						<div align="left" style="float:left;height:20px;width:145px;"><input type="text" name="features'.$i.'" /></div>
						<div align="left" style="float:left;height:15px;width:760px;"></div>
						<div align="right" style="float:left;height:20px;width:100px;">Brand :&nbsp;&nbsp;</div>
						<div align="left" style="float:left;height:20px;width:145px;"><input type="text" name="brand'.$i.'" /></div>
						<div align="right" style="float:left;height:20px;width:100px;">Model No. :&nbsp;&nbsp;</div>
						<div align="left" style="float:left;height:20px;width:145px;"><input type="text" name="modelNo'.$i.'" /></div>
						<div align="right" style="float:left;height:20px;width:100px;">Part No. :&nbsp;&nbsp;</div>
						<div align="left" style="float:left;height:20px;width:145px;"><input type="text" name="partNo'.$i.'" /></div>
						<div align="left" style="float:left;height:5px;width:760px;"></div>
						<div align="right" style="float:left;height:20px;width:100px;">Others :&nbsp;&nbsp;</div>
						<div align="left" style="float:left;height:20px;width:145px;">
						  <textarea name="others'.$i.'" rows="4"></textarea>
						</div>
						<div align="right" style="float:left;height:20px;width:130px;"> Attachment :&nbsp;&nbsp;</div>
						<div align="left" style="float:left;height:20px;width:145px;"><input type="hidden" name="MAX_FILE_SIZE1'.$i.'" value="2000000"><input type="file" name="attachment1'.$i.'" /><input type="hidden" name="MAX_FILE_SIZE2'.$i.'" value="2000000">
						  <input type="file" name="attachment2'.$i.'" /></div>
			  			</div>
						  ';
			  		}
				}
			?>
			
		
	
	
	</div>
  <!-- *********************************END CENTER MENU****************************** -->
    
</td>
</tr></table>
</form>
</body>
</html>
