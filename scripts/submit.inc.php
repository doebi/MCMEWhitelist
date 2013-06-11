<?php
//get input
$error = "";
$username = mysql_real_escape_string(stripslashes($_POST['username']));
$mail = mysql_real_escape_string(stripslashes($_POST['email']));
if($username != ""){
	$stream = fopen("http://www.minecraft.net/haspaid.jsp?user=".$username, "r");
	$namecheck = fgets($stream);
	fclose($stream);
	if($namecheck == "true"){
		if(ereg("^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+\.)+([a-zA-Z]{2,6})$", $mail)){
			if($_POST['birth'] < 2013){
				$birth = mysql_real_escape_string(stripslashes($_POST['birth']));
				if(strlen($_POST['why']) > 5){
					$why = mysql_real_escape_string(stripslashes($_POST['why']));
					if(strlen($_POST['skills']) > 5){
						$skills = mysql_real_escape_string(stripslashes($_POST['skills']));
						if(strlen($_POST['special']) > 5){
							$special = mysql_real_escape_string(stripslashes($_POST['special']));
								if(isset($_POST['mine'])){
									$question1 = mysql_real_escape_string(stripslashes($_POST['mine']));
									if(isset($_POST['job'])){
										$question2 = mysql_real_escape_string(stripslashes($_POST['job']));
										if(isset($_POST['terrain'])){
											$question3 = mysql_real_escape_string(stripslashes($_POST['terrain']));
											if(isset($_POST['tos'])){
												$tos = mysql_real_escape_string(stripslashes($_POST['tos']));
												//check if answers are correct
												$correct = 0;
												if($question1 == $q1 && $question2 == $q2 && $question3 == $q3){
													$correct = 1;
												}else{
													$correct = 0;
												}
												$appid = md5($username.time().$secret);
												$time = time();
												$special = mysql_real_escape_string(stripslashes($_POST['special']));						
												$skills = mysql_real_escape_string(stripslashes($_POST['skills']));						
												$ip = $_SERVER['REMOTE_ADDR'];
												$host = gethostbyaddr($ip);
												$stream = fopen("http://api.hostip.info/country.php?ip=".$ip, "r");
												$country = fgets($stream);
												fclose($stream);
												//Check for multiple submissions
												$result = mysql_num_rows(mysql_query("SELECT * FROM applies WHERE username = '$username' AND reviewed = '0'"));
												if($result == 0){
													$check = mysql_query("INSERT INTO `applies` (`id`, `appid`, `applytime`, `username`, `mail`, `ip`, `host`, `country`, `birth`, `question1`, `question2`, `question3`, `why`, `skills`, `special`, `correct`) VALUES (NULL, '$appid', '$time', '$username', '$mail', '$ip', '$host', '$country', '$birth', '$question1', '$question2', '$question3', '$why', '$skills', '$special', '$correct')");
													if($check == true){
														include(TEMPLATES."success.inc.php");
													}else{
														$error = "UH OH, CALL THE SYSADMIN QUICK! IT'S ALL BROKEN!";
													}
												}else{
													$error = "You already submitted your application.";
												}
											}else{
												$error = "You need to accept the TOS and Rules.";
											}
										}else{
											$error = "Please answer question 3.";
										}
									}else{
										$error = "Please answer question 2.";
									}
								}else{
									$error = "Please answer question 1.";
								}
						}else{
							$error = "Tell us why you think you're special.";
						}
					}else{
						$error = "Tell us about your skills.";
					}
				}else{
					$error = "Tell us why you want to join us.";
				}
			}else{
				$error = "Your birth year is required to apply for whitelist";
			}
		}else{
			$error = "The email you entered is invalid.";
		}
	}else{
		$error = "The entered Username is not premium.";
	}
}else{
	$error = "We need your username to whitelist you.";
}
if($error != ""){
	include(TEMPLATES."nosuccess.inc.php");
}
?>