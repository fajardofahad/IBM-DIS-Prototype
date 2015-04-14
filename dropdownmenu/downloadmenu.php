<!-- *********************************Start Menu Top Downloads****************************** -->
<div class="mainDiv" >
<div class="topItem" align="left">Top Downloads</div>        
<div class="dropMenu" align="left"><!-- -->
	<div class="subMenu" style="display:inline;">
	<?php
	include("db/connect.php");
		$sql_cmbNature = 'Select * from download where status = \'Active\' ';
		$result = mysql_query($sql_cmbNature) or die(mysql_error());
		$num = mysql_num_rows($result);
			
			if ($num > 0) {
				for($i=0; $i<$num; $i++) {
					$row = array();
					$row = mysql_fetch_array($result);
					
					if($i ==4){
						break;
					}
					
					$name = $row['name'];
					$id = $row['id'];
					
					echo '<div class="subItem"><a href="downloader/download.php?id='.$id.'" style="color:#064293">'.$name.'</a></div>';
	    		
				}
			}
	?>
		<div class="subItem" align="center"><a href="downloads.php">[view all]</a></div>
	</div>
</div>
</div>
<!-- *********************************End Menu Downloads****************************** -->