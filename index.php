<?php
ini_set('display_errors','1');
session_start();
//disable errors
//let's set up a root path constant
define('ROOT',getcwd().DIRECTORY_SEPARATOR);
define('CONFIG',ROOT.'config'.DIRECTORY_SEPARATOR);
//load in the main configuration file
include_once(CONFIG.'base.inc.php');
define('OROOT',"http://".$host."/whitelist/");
 
//define the includes and config folders
define('IMAGES', "http://".$host.'/img/');
define('STYLES', "http://".$host.'/styles/');
define('LIB',OROOT.'lib/');
define('SCRIPTS',ROOT.'scripts'.DIRECTORY_SEPARATOR);
define('TEMPLATES',ROOT.'templates'.DIRECTORY_SEPARATOR);

//connect to db
mysql_connect($sqlhost,$sqluser,$sqlpass);
mysql_select_db("$sqlbase");

//kick officers after 10 minutes
$deadline = time()-600;
mysql_query("UPDATE officers SET token = '' WHERE time < '$deadline'");

//reject incorrect applies after a week
$deadline = time()-172800;
mysql_query("UPDATE applies SET reviewed = '1' WHERE applytime < '$deadline' AND correct = '0'");

	if(isset($_POST['type'])){
		$type = mysql_real_escape_string(stripslashes($_POST['type']));
		switch ($type) {
			case 'submit': {
				//Receive submit data
				include(TEMPLATES."header.inc.php");
				include(SCRIPTS."submit.inc.php");
				break;
			}
			case 'login': {
				//Officer tries to login
				include(TEMPLATES."header.inc.php");
				include(SCRIPTS."login.inc.php");
				break;
			}
			case 'accept': {
				include(SCRIPTS."accept.inc.php");
				break;
			}
			case 'reject': {
				include(SCRIPTS."reject.inc.php");
				break;
			}
			case 'logout': {
				$uid = $_SESSION['uid'];
				session_destroy();
				mysql_query("UPDATE officers SET token = '' WHERE uid = '$uid'");
				header("Location: ".OROOT."officer");
				break;
			}
			default:{
				header("Location: ".OROOT."apply");
				break;
			}
		}
	}
	else{
		if(isset($_GET['route'])){
			$args = explode("/", $_GET['route']);
			$mode = $args[2];
			switch ($mode) {
				case 'apply': {
			 		//show apply form
						include(TEMPLATES."header.inc.php");
				 		include(TEMPLATES."apply.inc.php");
	 				include(TEMPLATES."footer.inc.php");
			 		break;
		 		}
				case 'officer': {
			 		//show officer login
					include(TEMPLATES."header.inc.php");
				 	include(TEMPLATES."officer.inc.php");
	 				include(TEMPLATES."footer.inc.php");
			 		break;
		 		}
		 		case 'stats': {
			 		//show stats
					include(TEMPLATES."header.inc.php");
				 	include(TEMPLATES."stats.inc.php");
	 				include(TEMPLATES."footer.inc.php");
			 		break;
		 		}
		 		case '': {
			 		//redirect
					header("Location: ".OROOT."apply");
			 		break;
		 		}
		 		case 'fetch': {
				 	include(SCRIPTS."fetch.inc.php");
			 		break;
		 		}
		 		case 'history': {
					include(TEMPLATES."header.inc.php");
				 	include(TEMPLATES."history.inc.php");
	 				include(TEMPLATES."footer.inc.php");
			 		break;
		 		}
		 		case 'admin': {
					include(TEMPLATES."header.inc.php");
				 	include(TEMPLATES."admin.inc.php");
	 				include(TEMPLATES."footer.inc.php");
			 		break;
		 		}
			 	default: {
				 	//show error, mode not found
					include(TEMPLATES."header.inc.php");
				 	include(TEMPLATES."404.inc.php");
	 				include(TEMPLATES."footer.inc.php");
				 	break;
			 	}
		 	}
	 	}
		else{
		 	header("Location: ".OROOT."apply");
		}
	}
?>
