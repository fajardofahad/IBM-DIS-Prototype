<!-- *********************************Start Menu Top Downloads****************************** -->
<div class="mainDiv" >
<div class="topItem" align="left">Login</div>        
<div class="dropMenu" align="left"><!-- -->
	<div class="subMenu" style="display:inline;">
		<?php
		//redirect to process.php
		if(isset($_GET["msg"]))
		{
			if($_GET["msg"] == 1)
			{
			echo '<span class="errorMsg">'."Invalid Email or Password!!"."</span>";
			}
			if($_GET["msg"] == 2)
			{
			echo '<span class="errorMsg">'."You have successfully log-out!!"."</span>"."<br>";
			}
			if($_GET["msg"] == 3)
			{
			echo '<span class="errorMsg">'."Please Log-in!!"."</span>"."<br>";
			}
		}
		?>
	    <div class="subItem">Email:</div>
		<div class="subItem"><?php echo '<input type="text" name="Email" />'; ?></div>
		<div class="subItem">Password:</div>
		<div class="subItem"><?php echo '<input type="password" name="Password" />'; ?></div>
		<div class="subItem"><?php echo '<input type="submit" name="submit" value="Login" />'; ?></div>
		<div class="subItem"><br /></div>
	</div>
</div>
</div>
<!-- *********************************End Menu Downloads****************************** -->