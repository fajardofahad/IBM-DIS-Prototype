<?php

//requestNo, requestor, respondent, message, id
//INSERT ITEM TO DATABASE	
$insertHistory = "Insert into history (requestNo, requestor, respondent, message, datePosted) values('$Rn','$requestorName','$respondent','$message','$datePosted')";
$result = mysql_query($insertHistory) or die (mysql_error());

?>