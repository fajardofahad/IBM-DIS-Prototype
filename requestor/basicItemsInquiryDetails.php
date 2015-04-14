<?php
include('../mailStatus.php');
//header
echo '<table width="907" border="0" cellpadding="0" cellspacing="1" bgcolor="#FFFFFF">
          <tr  bgcolor="#FFFFFF">
           <td width="52" height="21" align="center" valign="middle" bgcolor="#333333" class="small"><strong>Item No </strong></td>
            <td width="111" align="center" valign="middle" bgcolor="#333333" class="small"><strong>* Item Description </strong></td>
            <td width="60" align="center" valign="middle" bgcolor="#333333" class="small"><strong>* Quantity</strong></td>
            <td width="50" align="center" valign="middle" bgcolor="#333333" class="small"><strong>Size</strong></td>
            <td width="52" align="center" valign="middle" bgcolor="#333333" class="small"><strong>Color</strong></td>
            <td width="73" align="center" valign="middle" bgcolor="#333333" class="small"><strong>Material</strong></td>
            <td width="74" align="center" valign="middle" bgcolor="#333333" class="small"><strong>Features</strong></td>
            <td width="58" align="center" valign="middle" bgcolor="#333333" class="small"><strong>Brand</strong></td>
            <td width="81" align="center" valign="middle" bgcolor="#333333" class="small"><strong>Model No </strong></td>
            <td width="67" align="center" valign="middle" bgcolor="#333333" class="small"><strong>Part No </strong></td>
            <td width="122" align="center" valign="middle" bgcolor="#333333" class="small"><strong>Others</strong></td>
            <td width="94" align="center" valign="middle" bgcolor="#333333" class="small"><strong>* Date Needed </strong></td>
  </tr>';
  
	  	$sql_rfq = 'Select * from rfq_basic_item where requestNo = \''.$requestNo.'\'';
		$result = mysql_query($sql_rfq) or die(mysql_error());
		$num = mysql_num_rows($result);
		
			if ($num > 0) {
				for($i=0; $i<$num; $i++) {
					$row = array();
					$row = mysql_fetch_array($result);

echo'
          <tr>
           <td width="52" height="21" align="center" valign="middle" bgcolor="#999999" class="small style1">'.$row['itemNo'].'</td>
            <td width="111" align="center" valign="middle" bgcolor="#999999" class="small style1">'.$row['items'].'</td>
            <td width="60" align="center" valign="middle" bgcolor="#999999" class="small style1">'.$row['quantity'].'</td>
            <td width="50" align="center" valign="middle" bgcolor="#999999" class="small style1">'.$row['size'].'</td>
            <td width="52" align="center" valign="middle" bgcolor="#999999" class="small style1">'.$row['color'].'</td>
            <td width="73" align="center" valign="middle" bgcolor="#999999" class="small style1">'.$row['material'].'</td>
            <td width="74" align="center" valign="middle" bgcolor="#999999" class="small style1">'.$row['features'].'</td>
            <td width="58" align="center" valign="middle" bgcolor="#999999" class="small style1">'.$row['brand'].'</td>
            <td width="81" align="center" valign="middle" bgcolor="#999999" class="small style1">'.$row['modelNo'].'</td>
            <td width="67" align="center" valign="middle" bgcolor="#999999" class="small style1">'.$row['partNo'].'</td>
            <td width="122" align="center" valign="middle" bgcolor="#999999" class="small style1">'.$row['others'].'</td>
            <td width="94" align="center" valign="middle" bgcolor="#999999" class="small style1">'.$row['dateNeeded'].'</td>
  </tr>
';
				}
			}
echo '</table>';
?>