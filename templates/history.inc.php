<center>
<?php
if(isset($_SESSION['uid']) && isset($_SESSION['token'])){
	$uid = mysql_real_escape_string(stripslashes($_SESSION['uid']));
	$token = mysql_real_escape_string(stripslashes($_SESSION['token']));
	$result = mysql_fetch_assoc(mysql_query("SELECT token FROM officers WHERE uid = '$uid'"));
	if($result['token'] == $token){
		include(TEMPLATES."sidebar.inc.php");
		$data = mysql_query("SELECT * FROM applies WHERE reviewed = '1' AND correct = '1' ORDER BY `applytime` DESC LIMIT 0, 100");
		if(mysql_num_rows($data)){
			echo "<table style='float:right; margin-right:5px;'>";
			echo "<tr><th>ID</th><th>Username</th><th>Applied at:</th><th>Result</th><th>Reviewed at:</th><th>Reviewed by:</th></tr>";
		  while ($row = mysql_fetch_assoc($data)) {
		  	$state = "<span style='color:red'>REJECTED</span>";
		  	if($row['accepted']==1){
		  		$state = "<span style='color:green'>ACCEPTED</span>";
		  	}
		  	echo "<tr><td>".$row['id']."</td><td>".$row['username']."</td><td>".date('l jS \of F Y h:i:s A',$row['applytime'])."</td><td>".$state."</td><td>".date('l jS \of F Y h:i:s A',$row['reviewtime'])."</td><td>".$row['officer']."</td></tr>";
			}
			echo "</table>";
		}else{
			echo "<div class='item'><b>No Applications</b></div>";
		}
	}else{
		//force logout
		session_destroy();
		mysql_query("UPDATE officers SET token = '' WHERE uid = '$uid'");
		$error = "Failed Token check!";
		include(TEMPLATES."loginform.inc.php");
	}
}else{
	$error = "Login to access the Officer Area!";
	include(TEMPLATES."loginform.inc.php");
}
?>
</center>
