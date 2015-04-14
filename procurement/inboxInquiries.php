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
<script type="text/javascript" src="../css/xpmenuv21.js"></script>
<script language="javascript" type="text/javascript"  src="../javascript/calendarHandler.js"></script>
<script type="text/javascript"  > 
function sendMessages(requestId){

	if(document.forms['requestForm'].messageField.value == ""){
	 alert("Message field mus have a value.");
	 document.forms['requestForm'].messageField.focus();
	}else{
		document.forms['requestForm'].action = "sendMessage.php?requestID="+requestId;
		document.forms['requestForm'].submit();
	} 

}

function closeRequest(requestId){

	if(document.forms['requestForm'].messageField.value == ""){
	 alert("Message field mus have a value.");
	 document.forms['requestForm'].messageField.focus();
	}else{
		document.forms['requestForm'].action = "closeRequest.php?requestID="+requestId;
		document.forms['requestForm'].submit();
	} 

}
function cancelRequest(requestId){

	if(document.forms['requestForm'].messageField.value == ""){
	 alert("Message field mus have a value.");
	 document.forms['requestForm'].messageField.focus();
	}else{
		document.forms['requestForm'].action = "cancelRequest.php?requestID="+requestId;
		document.forms['requestForm'].submit();
	} 

}

function openRequest(requestId){

	if(document.forms['requestForm'].messageField.value == ""){
	 alert("Message field mus have a value.");
	 document.forms['requestForm'].messageField.focus();
	}else{
		document.forms['requestForm'].action = "openRequest.php?requestID="+requestId;
		document.forms['requestForm'].submit();
	} 

}


</script>
<script type="text/javascript">

/***********************************************
* Dynamic Ajax Content- © Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
***********************************************/

var loadedobjects=""
var rootdomain="http://"+window.location.hostname

function ajaxpage(url, containerid){
var page_request = false
if (window.XMLHttpRequest) // if Mozilla, Safari etc
page_request = new XMLHttpRequest()
else if (window.ActiveXObject){ // if IE
try {
page_request = new ActiveXObject("Msxml2.XMLHTTP")
} 
catch (e){
try{
page_request = new ActiveXObject("Microsoft.XMLHTTP")
}
catch (e){}
}
}
else
return false
page_request.onreadystatechange=function(){
loadpage(page_request, containerid)
}
page_request.open('GET', url, true)
page_request.send(null)
}

function loadpage(page_request, containerid){
if (page_request.readyState == 4 && (page_request.status==200 || window.location.href.indexOf("http")==-1))
document.getElementById(containerid).innerHTML=page_request.responseText
}

function loadobjs(){
if (!document.getElementById)
return
for (i=0; i<arguments.length; i++){
var file=arguments[i]
var fileref=""
if (loadedobjects.indexOf(file)==-1){ //Check to see if this object has not already been added to page before proceeding
if (file.indexOf(".js")!=-1){ //If object is a js file
fileref=document.createElement('script')
fileref.setAttribute("type","text/javascript");
fileref.setAttribute("src", file);
}
else if (file.indexOf(".css")!=-1){ //If object is a css file
fileref=document.createElement("link")
fileref.setAttribute("rel", "stylesheet");
fileref.setAttribute("type", "text/css");
fileref.setAttribute("href", file);
}
}
if (fileref!=""){
document.getElementsByTagName("head").item(0).appendChild(fileref)
loadedobjects+=file+" " //Remember this object as being already added to page
}
}
}

</script>

<style type="text/css">
#leftcolumn{
float:left;
width:550px;
margin-left: 10px;
padding: 5px;
border: 1px solid gray;

}

#leftcolumn a{
padding: 3px 1px;
display: block;
text-decoration: none;
font-weight: bold;
border-bottom: 1px solid gray;
}

#leftcolumn a:hover{
background-color: lightcyan;
}

#rightcolumn{
float:left;
width:550px;
/*min-height: 400px;*/
border: 1px solid gray;
/*margin-left: 10px;*/
padding: 5px;
padding-bottom: 8px;
}

* html #rightcolumn{ /*IE only style*/
height: 400px;
}
.style1 {color: #000000}
</style>
</head>
<body>
<form action="#" method="post" name="requestForm">
<table width="948">
<tr><td colspan="2"><img src="../images/Header.gif" width="900" height="175" /></td></tr>
<tr><td colspan="2" align="right" background="../images/nav.jpg"></td></tr>
<tr><td width="99" valign="top" >
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
<td width="837" align="left" valign="top">
  <!-- *********************************START CENTER MENU****************************** -->

	<table width="790" border="0">
      <tr>
        <td width="285" align="left" valign="middle"><span style="float:inherit"><span style="width:250px">
          <?php 
  
  if(isset($_GET['msg'])){
		$msg = $_GET['msg'];
		echo "<span class=\"errorMsg\"><b>". $msg ."</b></span>";
	}
	?>
        </span></span></td>
        <td width="495"><span style="float:inherit"><img align="right" src="../images/inboxInquiries.jpg"/></span></td>
      </tr>
      <tr>
        <td height="103" colspan="2" align="right" valign="top"><table width="785" border="0" cellpadding="1" cellspacing="1">
          <tr>
            <td colspan="3"><h3 style="border-bottom: 1px solid #C0C0C0; margin-bottom: -5px"><strong><img src="../images/Search.png" width="29" height="27" border="0" />Search Engine </strong></h3>
            <br /></td>
            </tr>
          <tr>
            <td width="237" align="right" valign="middle">Requestor :
              <input name="searchRequestor" type="text" id="searchRequestor" /></td>
            <td colspan="2" align="right" valign="middle">
              <input name="Search" type="submit" id="Search" value="Search" />
              <input name="reset" type="reset" id="reset" value="Clear Form" />
              <input name="sendOutbox" type="button" id="sendOutbox" value="Send to Outbox" /></td></tr>
          <tr>
            <td align="right" valign="middle">&nbsp;</td>
            <td colspan="2" align="left" valign="middle">&nbsp;</td>
          </tr>
          <tr>
            <td align="right" valign="middle">Request No :
              <input name="searchRequestNo" type="text" id="searchRequestNo" /></td>
            <td colspan="2" align="left" valign="middle">&nbsp;&nbsp;&nbsp;Date Start :
              <input type="text" align="middle"  name="DateStart" onfocus="clearValue('DateStart');" readonly="true" size="10" />
                <a href="JavaScript:cal1.popup();" onclick="clearValue('DateStart');',' calendarChecker();"><img src="../images/calendar/cal.gif" width="19" height="19" border="0" alt="Click this to select the start date of this event." /></a>
                <script language="JavaScript" type="text/javascript">
							var cal1 = new calendar1(document.forms['requestForm'].elements['DateStart']);
							cal1.year_scroll = true;
							cal1.time_comp = false;
									  </script>
               &nbsp;&nbsp; Date End :
                <input type="text" align="middle"  name="DateEnd" onfocus="clearValue('DateEnd');" readonly="true" size="10" />
                <a href="JavaScript:cal2.popup();" onclick="clearValue('DateEnd');',' calendarChecker();"><img src="../images/calendar/cal.gif" width="19" height="19" border="0" alt="Click this to select the start date of this event." /></a>
                <script language="JavaScript" type="text/javascript">
							var cal2 = new calendar1(document.forms['requestForm'].elements['DateEnd']);
							cal2.year_scroll = true;
							cal2.time_comp = false;
									  </script></td>
            </tr>
          <tr>
            <td align="right" valign="middle">&nbsp;</td>
            <td colspan="2" align="left" valign="middle">&nbsp;</td>
          </tr>
          <tr>
            <td height="27" align="right" valign="middle">Cart ID :
              <input name="searchCartId" type="text" id="searchCartId" maxlength="10" /></td>
            <td width="278" align="left" valign="middle">&nbsp;&nbsp;&nbsp;Status :
              <select name="searchRequestStatus">
                  <option value="-" selected="selected">Select Status</option>
                  <option value="0">New/Answered Requests</option>
                  <option value="1">Viewed Requests</option>
                  <option value="2">Responded Requests</option>
                  <option value="3">Closed Requests</option>
                  <option value="4">Cancelled Requests</option>
                  <option value="5">Opened Requests</option>
                </select>            </td>
            <td width="260" align="left" valign="middle">Sorting :
              <select name="searchSorting" id="searchSorting">
                <option value="-">Select Sorting</option>
                <option value="ASC">Ascending</option>
                <option value="DESC">Descending</option>
              </select></td>
          </tr>
          
          
          <tr>
            <td colspan="3"><h3 style="border-bottom: 1px solid #C0C0C0; margin-bottom: -5px"></h3><br /></td>
          </tr>
        </table>
        </td>
      </tr>
      <tr>
        <td colspan="2" align="left" valign="top">
		<?php
			include('tabInbox.php');
		
		?>		</td>
        </tr>
      <tr>
        <td colspan="2" bgcolor="#99AAE0">&nbsp;</td>
      </tr>
     	<tr>
        <td colspan="2" align="left" valign="top">
		<?php include('lowermenuiframe.php'); ?>		</td>
      </tr>
    </table>
	<br />
	<br />
	
	<!------------------------------ REQUEST BODY -------------------------------->
	<!------------------------------ END REQUEST BODY -------------------------------->
    <!-- *********************************END CENTER MENU****************************** --></td>
</tr></table>
</form>
</body>
</html>
