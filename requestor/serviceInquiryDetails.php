<?php
include('../mailStatus.php');
//header
echo '<table width="685" border="0" cellpadding="0" cellspacing="1" bgcolor="#FFFFFF">
          <tr  bgcolor="#FFFFFF">
           <td width="57" height="21" align="center" valign="middle" bgcolor="#333333" class="small"><strong>Item No </strong></td>
            <td width="204" align="center" valign="middle" bgcolor="#333333" class="small"><strong>* Nature of Service </strong></td>
            <td width="99" align="center" valign="middle" bgcolor="#333333" class="small"><strong>* Start Date </strong></td>
            <td width="92" align="center" valign="middle" bgcolor="#333333" class="small"><strong>* End Date </strong></td>
            <td width="227" align="center" valign="middle" bgcolor="#333333" class="small"><strong>Suggested Supplier </strong><strong></strong></td>
  </tr>
';
  
	  	$sql_rfq = 'Select * from rfq_service where requestNo = \''.$requestNo.'\'';
		$result = mysql_query($sql_rfq) or die(mysql_error());
		$num = mysql_num_rows($result);
		
			if ($num > 0) {
				for($i=0; $i<$num; $i++) {
					$row = array();
					$row = mysql_fetch_array($result);

echo'<tr  bgcolor="#FFFFFF">
            <td height="21" align="center" valign="middle" bgcolor="#999999" class="small style1">1</td>
            <td align="center" valign="middle" bgcolor="#999999" class="small style1">'.$row['natureOfService'].'</td>
            <td align="center" valign="middle" bgcolor="#999999" class="small style1">'.$row['startDate'].'</td>
            <td align="center" valign="middle" bgcolor="#999999" class="small style1">'.$row['endDate'].'</td>
            <td align="center" valign="middle" bgcolor="#999999" class="small style1">'.$row['suggestedSupplier'].'</td>
          </tr>        
';
				}
			}
echo '</table>';


?>