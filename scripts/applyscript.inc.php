<script>
	var officer = "<?php echo $_SESSION['username']; ?>";
	var token = "<?php echo $_SESSION['token']; ?>";
	
	function process(action, appid){
		document.getElementById(appid).innerHTML = "<img src='<?php echo IMAGES; ?>ajax-loader.gif'> Processing...";
		$.ajax({
			type: "POST",
			url: "",
			data: "type="+action+"&appid="+appid+"&officer="+officer+"&token="+token
		}).done(function(msg){response(msg)});
	}
	
	function response(msg){
		data = msg.split(":");
		if(data[0] == "accepted"){
			document.getElementById(data[1]).innerHTML = "<b>ACCEPTED</b>";
		}
		if(data[0] == "rejected"){
			document.getElementById(data[1]).innerHTML = "<b>REJECTED</b>";
		}
	}
</script>