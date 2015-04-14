<?php
include('../mailStatus.php');
//header
echo '<table width="773" border="0" cellpadding="0" cellspacing="1" bgcolor="#FFFFFF">
          <tr  bgcolor="#FFFFFF">
           <td width="66" height="21" align="center" valign="middle" bgcolor="#333333" class="small"><strong>Item No </strong></td>
            <td width="175" align="center" valign="middle" bgcolor="#333333" class="small"><strong>* Item Description </strong></td>
            <td width="74" align="center" valign="middle" bgcolor="#333333" class="small"><strong>* Quantity </strong></td>
            <td width="142" align="center" valign="middle" bgcolor="#333333" class="small"><strong>* Material </strong></td>
            <td width="92" align="center" valign="middle" bgcolor="#333333" class="small"><strong>* Size </strong></td>
            <td width="119" align="center" valign="middle" bgcolor="#333333" class="small"><strong>* Color </strong></td>
            <td width="97" align="center" valign="middle" bgcolor="#333333" class="small"><strong>* Date Needed </strong></td>
  </tr>
';
  
	  	$sql_rfq = 'Select * from rfq_item where requestNo = \''.$requestNo.'\'';
		$result = mysql_query($sql_rfq) or die(mysql_error());
		$num = mysql_num_rows($result);
		
			if ($num > 0) {
				for($i=0; $i<$num; $i++) {
					$row = array();
					$row = mysql_fetch_array($result);

echo'  <tr  bgcolor="#FFFFFF">
            <td height="21" align="center" valign="middle" bgcolor="#999999" class="small style1">'.$row['itemNo'].'</td>
            <td align="center" valign="middle" bgcolor="#999999" class="small style1">'.$row['item'].'</td>
            <td align="center" valign="middle" bgcolor="#999999" class="small style1">'.$row['quantity'].'</td>
            <td align="center" valign="middle" bgcolor="#999999" class="small style1">'.$row['material'].'</td>
            <td align="center" valign="middle" bgcolor="#999999" class="small style1">'.$row['size'].'</td>
            <td align="center" valign="middle" bgcolor="#999999" class="small style1">'.$row['color'].'</td>
            <td align="center" valign="middle" bgcolor="#999999" class="small style1">'.$row['dateNeeded'].'</td>
          </tr>
';
				}
			}
echo '</table>';
?>