<?php
if($accronim == 'MIR' || $accronim == 'RFQ'){
	  
		$sql_attachment = 'Select * from uploadfiles where requestNo = \''.$requestNo.'\';';
		$result1 = mysql_query($sql_attachment) or die(mysql_error());
		$num1 = mysql_num_rows($result1);
			
			if ($num1 > 0) {
				echo '<h3 style="border-bottom: 1px solid #C0C0C0; margin-bottom: -5px">Attachments : </h3><br />
							<table width="533" border="0" cellpadding="0" cellspacing="1" bgcolor="#FFFFFF">
					  <tr>
						<td width="224" height="17" align="center" valign="middle" bgcolor="#333333" class="small"><strong>Name</strong></td>
						<td width="102" align="center" valign="middle" bgcolor="#333333" class="small"><strong>Item No </strong></td>
						<td width="100" align="center" valign="middle" bgcolor="#333333" class="small"><strong>Size</strong></td>
						<td width="102" align="center" valign="middle" bgcolor="#333333" class="small"><strong>Download</strong></td>
					  </tr>';
				  
				for($i=0; $i<$num1; $i++) {
					$row1 = array();
					$row1 = mysql_fetch_array($result1);
					
					$name = $row1['name'];
					$itemLine = $row1['itemLine'];
					$size = $row1['size'];
					$id = $row1['requestNo'];
					
	 				 echo '<tr>
       			<td align="center" valign="middle" bgcolor="#999999" class="small style1">'.$name.'</td>
        		<td align="center" valign="middle" bgcolor="#999999" class="small style1">'.$itemLine.'</td>
        		<td align="center" valign="middle" bgcolor="#999999" class="small style1">'.$size.' kb</td>
        		<td align="center" valign="middle" bgcolor="#999999" class="small style1"><a href="../downloader/attachment.php?id='.$id.'" style="color:#064293"><img src="../images/attachment.gif" border="0" /></a></td>
      			</tr>';
				
			}
		}
		echo '</table>';
}


?>