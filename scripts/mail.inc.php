<?php
function sendMail($type, $appid){
	$fetchinfo = mysql_fetch_assoc(mysql_query("SELECT * FROM applies WHERE appid = '$appid'"));
	$mailto = $fetchinfo['mail'];
	$user = $fetchinfo['username'];
	require_once "swift_required.php";
	$transport = Swift_SmtpTransport::newInstance('ssl://smtp.gmail.com', 465)
	->setUsername('admissions@mcme.co')
	->setPassword('redribbon');
	$mailer = Swift_Mailer::newInstance($transport);
	$content = file_get_contents(TEMPLATES.$type.".html");
	$message = Swift_Message::newInstance()
	->setSubject('Minecraft Middle-Earth Whitelist Application')
	->setFrom(array('admission@mcme.co' => 'MCME Admissions Council'))
	->setTo(array($mailto => $user))
	->setBody($content, "text/html");
	return $mailer->send($message);
}