<?php
	$username = mysql_real_escape_string($_POST['username']);
	$password = md5($_POST['password']);

	if(empty($username) or empty($password)){
		$error = "Input your Username and Password!";
		include(TEMPLATES."loginform.inc.php");
		exit;
	}else{
		$result = mysql_query("SELECT * FROM officers WHERE username = '$username' AND password = '$password'");
		$count = mysql_num_rows($result);
		if($count == 1){
			$array = mysql_fetch_array($result);
			if($array['active']==0){
				#not activated
				$error = "You are not activated!";
				include(TEMPLATES."loginform.inc.php");
				exit;
			}
			else{
				// Login
				session_start();
				$uid = $array['uid'];
				$_SESSION['uid'] = $uid;
				$_SESSION['username'] = $username;
				$token = md5($uid.time().$secret);
				$time = time();
				mysql_query("UPDATE officers SET token = '$token' WHERE uid = '$uid' AND username = '$username'");
				mysql_query("UPDATE officers SET time = '$time'  WHERE uid = '$uid' AND username = '$username'");
				$_SESSION['token'] = $token;
				header('Location: '.OROOT."officer");
				exit;
			}
		}
		else{
			$error = "Login failed! Try again!";
			include(TEMPLATES."loginform.inc.php");
			exit;
		}
	}
?>