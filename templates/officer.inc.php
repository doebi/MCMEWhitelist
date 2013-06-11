<center>
<?php
if(isset($_SESSION['uid']) && isset($_SESSION['token'])){
	$uid = mysql_real_escape_string(stripslashes($_SESSION['uid']));
	$token = mysql_real_escape_string(stripslashes($_SESSION['token']));
	$result = mysql_fetch_assoc(mysql_query("SELECT token FROM officers WHERE uid = '$uid'"));
	if($result['token'] == $token){
		include(TEMPLATES."sidebar.inc.php");
		include(SCRIPTS."script.inc.php");
		$data = mysql_query("SELECT * FROM applies WHERE correct = '1' AND reviewed = '0'");
		if(mysql_num_rows($data)){
		  while ($row = mysql_fetch_assoc($data)) {
				$id = $row['id'];
		  	$username = $row['username'];
		  	$mail = $row['mail'];
			$country = strtolower($row['country']);
		  	$birth = $row['birth'];
		  	$appid = $row['appid'];
		  	$special = $row['special'];
		  	$skills = $row['skills'];
		  	$why = $row['why'];
				include(TEMPLATES."view-element.inc.php");
			}
		}else{
			echo "<div class='item'><b>No pending Applications</b></div>";
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