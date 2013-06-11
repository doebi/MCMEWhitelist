<?php
	$appid = $_POST['appid'];
	$officer = $_POST['officer'];
	$token = $_POST['token'];
	$time = time();
	$result = mysql_fetch_assoc(mysql_query("SELECT token FROM officers WHERE username = '$officer'"));
	if($result['token'] == $token){
		$fetchinfo = mysql_fetch_assoc(mysql_query("SELECT * FROM applies WHERE appid = '$appid'"));
		$user = $fetchinfo['username'];
		//update db
		$result = mysql_query("UPDATE applies SET reviewed = '1', accepted = '1', officer = '$officer', reviewtime = '$time' WHERE appid = '$appid'");
		if($result){
			//send mail
			include(SCRIPTS."mail.inc.php");
		  $result = sendMail("accept", $appid);
		  if($result){
				//add name to whitelist.txt
				$stream = fopen("/var/www/html/whitelist/whitelist.txt", "a");
				$result = fwrite($stream, "\n".$user);
				fclose($stream);
				if($result){
					//return success message
					echo "accepted:".$appid;
				}
				else{
					"error:".$appid.":failed adding to whitelist";
				}
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