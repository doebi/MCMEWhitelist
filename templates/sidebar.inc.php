<div class="sidebar">
	<div style="float:left;width:100px">
		<img src="http://minotar.net/helm/<?php echo $_SESSION['username']; ?>/64.png">
	</div>
	<div style="text-align:left">
		<span>Logged in as <?php echo $_SESSION['username']; ?></span><br>
		<form action="<?php echo OROOT; ?>" method="POST">
			<input type="hidden" name="type" value="logout" />
			<input type="submit" value="Logout" /><br />
		</form>
	</div>
	<div style="clear:both;margin-top:15px">
		<hr>
		<b>Online Officers:</b>
		<?php
			$data = mysql_query("SELECT * FROM officers WHERE token != ''");
			if(mysql_num_rows($data)){
				echo "<br>";
			  while ($row = mysql_fetch_assoc($data)) {
			  	echo "<span>".$row['username']."</span><br>";
				}
			}else{
				echo "No Officers Online!";
			}
		?>
		<hr>
		<a href="http://mcme.co/whitelist/officer">Pending Applications</a><br/>
		<a href="http://mcme.co/whitelist/history">Reviewed Applications</a><br/>
        <a href="http://mcme.co/whitelist/stats">Statistics</a><br/>
	</div>
</div>
<div style="display:none" class='rsidebar'>
	<div class='negative'>
   	Negative
  </div>
  <br>
  <div class='positive'>
  	Positive Message
  </div>
</div>
