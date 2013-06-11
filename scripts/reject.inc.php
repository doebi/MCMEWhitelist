<?php
	$appid = $_POST['appid'];
	$officer = $_POST['officer'];
	$token = $_POST['token'];
	$time = time();
	$result = mysql_fetch_assoc(mysql_query("SELECT token FROM officers WHERE username = '$officer'"));
	if($result['token'] == $token){
		//update db
		$result = mysql_query("UPDATE applies SET reviewed = '1', officer = '$officer', reviewtime = '$time' WHERE appid = '$appid'");
		if($result){
			//send mail
			include(SCRIPTS."mail.inc.php");
		  $result = sendMail("reject", $appid);
		  if($result){
					echo "rejected:".$appid;
			}else{
				"error:".$appid.":failed sending mail";
			}
		}else{
			"error:".$appid.":failed updating database";
		}
	}else{
		echo "error:".$appid.":Relog!";
	}
?>