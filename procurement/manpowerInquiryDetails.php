<?php
include('../mailStatus.php');
//header
echo '<table width="1387" border="0" cellpadding="0" cellspacing="1" bgcolor="#FFFFFF">
          <tr  bgcolor="#FFFFFF">
           <td width="51" height="21" align="center" valign="middle" bgcolor="#333333" class="small"><strong>Item No </strong></td>
            <td width="157" align="center" valign="middle" bgcolor="#333333" class="small"><strong>* Type Catalog </strong></td>
            <td width="174" align="center" valign="middle" bgcolor="#333333" class="small"><strong>* Contractor Name </strong></td>
            <td width="175" align="center" valign="middle" bgcolor="#333333" class="small"><strong>* Vendor </strong></td>
            <td width="139" align="center" valign="middle" bgcolor="#333333" class="small"><strong>* Designation </strong></td>
            <td width="132" align="center" valign="middle" bgcolor="#333333" class="small"><strong>* Department </strong></td>
            <td width="177" align="center" valign="middle" bgcolor="#333333" class="small"><strong> * ImmediateSupervisor</strong></td>
            <td width="92" align="center" valign="middle" bgcolor="#333333" class="small"><strong>* DateStart </strong></td>
            <td width="92" align="center" valign="middle" bgcolor="#333333" class="small"><strong>* Date End </strong></td>
            <td width="187" align="center" valign="middle" bgcolor="#333333" class="small"><strong> Others</strong></td>
  </tr>
';
  
	  	$sql_rfq = 'Select * from rfq_manpower where requestNo = \''.$requestNo.'\'';
		$result = mysql_query($sql_rfq) or die(mysql_error());
		$num = mysql_num_rows($result);
		
			if ($num > 0) {
				for($i=0; $i<$num; $i++) {
					$row = array();
					$row = mysql_fetch_array($result);
					
echo'  <tr  bgcolor="#FFFFFF">
            <td height="21" align="center" valign="middle" bgcolor="#999999" class="small style1">'.$row['itemNo'].'</td>
            <td align="center" valign="middle" bgcolor="#999999" class="small style1">'.$row['typeOfCatalog'].'</td>
            <td align="center" valign="middle" bgcolor="#999999" class="small style1">'.$row['contractorName'].'</td>
            <td align="center" valign="middle" bgcolor="#999999" class="small style1">'.$row['vendor'].'</td>
            <td align="center" valign="middle" bgcolor="#999999" class="small style1">'.$row['designation'].'</td>
            <td align="center" valign="middle" bgcolor="#999999" class="small style1">'.$row['department'].'</td>
            <td align="center" valign="middle" bgcolor="#999999" class="small style1">'.$row['immediateSupervisor'].'</td>
            <td align="center" valign="middle" bgcolor="#999999" class="small style1">'.$row['dateStart'].'</td>
            <td align="center" valign="middle" bgcolor="#999999" class="small style1">'.$row['dateEnd'].'</td>
            <td align="center" valign="middle" bgcolor="#999999" class="small style1">'.$row['others'].'</td>
          </tr>
';
				}
			}
echo '</table>';
?>