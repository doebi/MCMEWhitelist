<?php 
date_default_timezone_set('Europe/Brussels');
$now = date('Y');
$age = ($now - $birth)
?>
<div class="item" id="<?php echo $appid; ?>">
	<div style="float:left;width:100px">
		<img src="http://minotar.net/helm/<?php echo $username; ?>/64.png">
	</div>
	<div style="text-align:left">
    	<span style='float:right'>ID: <?php echo $id ?>
        <?php if ($country == "xx"){
			echo '<img src="http://www.mcme.co/img/xx.gif"height="32px">';
		}
		else {
			echo "<img src='http://www.geonames.org/flags/x/".$country.".gif'height='32px'>";
		}
		?>
        </span>
			<span>Username: <?php echo $username; ?></span><br>
			<span>Mail: <a href="mailto:<?php echo $mail; ?>"><?php echo $mail; ?></a></span><br>
	</div>
	<div style="clear:both;text-align:left;margin-top:40px">
			<span><b>Why i want to join:</b><br><i><?php echo $why; ?></i></span>
	</div>
	<div style="text-align:left;margin-top:10px">
			<span><b>My skills are:</b><br><i><?php echo $skills; ?></i></span>
	</div>
	<div style="text-align:left;margin-top:10px">
			<span><b>What makes me special:</b><br><i><?php echo $special; ?></i></span>
	</div>
	<div style="text-align:right;margin-top:10px">
		<input type="button" value="Accept" onclick="process('accept', '<?php echo $appid; ?>')">
		<input type="button" value="Reject" onclick="process('reject', '<?php echo $appid; ?>')">
	</div>
</div>