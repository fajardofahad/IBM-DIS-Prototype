<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="../css/tabcontent.css" />
<script type="text/javascript" src="../javascript/tabcontent.js">
</script>
</head>

<body>
<ul id="maintab" class="shadetabs">
<li class="selected"><a href="#" rel="tcontent1">Request for Quotation</a></li>
<li><a href="#" rel="tcontent2">Approved Bond Notification</a></li>
<li><a href="#" rel="tcontent3">Delivery Inquiry</a></li>
<li><a href="#" rel="tcontent4">Miscellaneous</a></li>
</ul>

<div class="tabcontentstyle">
  <div id="tcontent1" class="tabcontent" align="left"><img src="../images/Approved%20for%20Quotation.png" align="left"><br>
    
	
	<a href="basicItemsInquiry.php" class="colorwhite"><img src="../images/basicItems.jpg"  border="0"/></a><br />
	<a href="ServicesInquiry.php" class="colorwhite"><img src="../images/services.jpg"  border="0"/></a>
<?php
include("customizedmenu.php");
?>
	<a href="ManpowerInquiry.php" class="colorwhite"><img src="../images/manpower.jpg"  border="0"/></a><br />
	  <!-- <a href="javascript: expandtab('maintab', 3)">Click here to select <b>"Miscellaneous"</b> tab</a> -->
	 
    <br /><br />
	<p><b>Request for Quotation / Sourcing </b></p>
</div>
<div id="tcontent2" class="tabcontent" align="left"><img src="../images/Inquiry.png" align="left"><br>
    <p>&nbsp;</p>
    <p>Cart ID : <input name="approvedBondNotification" type="text" /><input name="Reset" type="reset" /><input name="Submit" type="button" value="Submit" onclick="JavaScript: ApprovedBondNotification();" />
    </p><br /><br /><br />
	<p><b>Approved Bond Notification / For PO issuance </b></p>
  </div>

<div id="tcontent3" class="tabcontent" align="left"><img src="../images/Delivery Inquiry.png" align="left"><br>
    <p>&nbsp;</p>
<p>Cart ID : <input name="DeliveryInquiry" type="text" /><input name="Reset" type="reset" /><input name="Submit" type="button" value="Submit" onclick="JavaScript: Delivery();" />
</p><br /><br /><br />
<p><b>Delivery Inquiry </b></p>
<p></p>
</div>

<div id="tcontent4" class="tabcontent" align="left"><img src="../images/Miscellaneous.png" align="left"><br>
   
<p>&nbsp;* Description : <br />
<textarea name="Description" type="text" cols="40" rows="5"  ></textarea><br />

</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* Attachment :<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="hidden" name="MAX_FILE_SIZE1" value="2000000"><input type="file" name="attachment1" /><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="file" name="attachment2" /></p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="hidden" name="MAX_FILE_SIZE2" value="2000000"><input name="Reset" type="reset" /><input name="Submit" type="button" value="Submit" onclick="JavaScript: MiscellaneousInquiry();" /> </p>
<p><b>Miscellaneous</b></p>
</div>
</div>

<script type="text/javascript">
//Start Tab Content script for UL with id="maintab" Separate multiple ids each with a comma.
initializetabcontent("maintab")
</script>

</body>
</html>
