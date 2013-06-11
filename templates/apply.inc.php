<body onLoad="setavatar(document.getElementById('username').value)">
<script>
function setavatar(usr)
{
	document.getElementById('facecontain').src = 'https://minotar.net/helm/' + usr + '/64.png';
	document.getElementById('warn').style.display = 'none';
}
</script>
<div class='content'>
<center><a href='http://mcmiddleearth.com'><img src='/img/mcme.png'></img></a><br/>
<h4>Whitelist Application</h4></center></div>
<div class='content'>

<p class='draw'>
Before submitting an application it is required that you read all of the rules of the server, they are located here: <a href="http://mcmiddleearth.com/rules" target="_blank">http://mcmiddleearth.com/rules</a> 
<br/><br/>
You must also read the Terms of Service, located here: <a href="http://mcmiddleearth.com/terms-of-service/" target="_blank">http://mcmiddleearth.com/terms-of-service/</a>
<br/><br/>
Please add "<a href="mailto:admissions@mcme.co">admissions@mcme.co</a>" (without quotes) to your address book to ensure that you receive your email regarding your application's status.
</p>
</div>
<br/>
<div class="content">
<form action="<?php OROOT; ?>" method="post" name="application">
<h2>Contact Information</h2>
<div class='element'>Minecraft Username: <input onKeyUp="setavatar(this.value)" name="username" id="username" type="text" size="16" maxlength="16"><span class='notice'>* </span></div>
<div class='element'>Email Address: <input name="email" maxlength="64" type="text" size="64"><span class='notice'>* </span></div>
<div class='element'>Year of Birth:
<select name="birth">
<option value="2013">2013</option>
<option value="2012">2012</option>
<option value="2011">2011</option>
<option value="2010">2010</option>
<option value="2009">2009</option>
<option value="2008">2008</option>
<option value="2007">2007</option>
<option value="2006">2006</option>
<option value="2005">2005</option>
<option value="2004">2004</option>
<option value="2003">2003</option>
<option value="2002">2002</option>
<option value="2001">2001</option>
<option value="2000">2000</option>
<option value="1999">1999</option>
<option value="1998">1998</option>
<option value="1997">1997</option>
<option value="1996">1996</option>
<option value="1995">1995</option>
<option value="1994">1994</option>
<option value="1993">1993</option>
<option value="1992">1992</option>
<option value="1991">1991</option>
<option value="1990">1990</option>
<option value="1989">1989</option>
<option value="1988">1988</option>
<option value="1987">1987</option>
<option value="1986">1986</option>
<option value="1985">1985</option>
<option value="1984">1984</option>
<option value="1983">1983</option>
<option value="1982">1982</option>
<option value="1981">1981</option>
<option value="1980">1980</option>
<option value="1979">1979</option>
<option value="1978">1978</option>
<option value="1977">1977</option>
<option value="1976">1976</option>
<option value="1975">1975</option>
<option value="1974">1974</option>
<option value="1973">1973</option>
<option value="1972">1972</option>
<option value="1971">1971</option>
<option value="1970">1970</option>
<option value="1969">1969</option>
<option value="1968">1968</option>
<option value="1967">1967</option>
<option value="1966">1966</option>
<option value="1965">1965</option>
<option value="1964">1964</option>
<option value="1963">1963</option>
<option value="1962">1962</option>
<option value="1961">1961</option>
<option value="1960">1960</option>
</select><span class='notice'>* </span> </div>
<hr/>
<h2>Minecraft Middle-Earth Community</h2>
<h4>Why do you want to join MCME?<span class='notice'>* </span></h4>
<div class='element'><textarea maxlength="640" name="why" rows="10"></textarea></div>
<h4>What skills can you bring to MCME?<span class='notice'>* </span></h4>
<div class='element'><textarea maxlength="640" name="skills" rows="10"></textarea></div>
<h4>What makes you special?<span class='notice'>* </span></h4>
<div class='element'><textarea maxlength="640" name="special" rows="10"></textarea></div>
<h2>Rules & Terms of Service</h2>
<h4>Are you allowed to mine blocks or cut down trees?<span class='notice'>* </span></h4> 
<div class='element'><input name="mine" type="radio" value="0">Yes</div>
<div class='element'><input name="mine" type="radio" value="1">No</div>
<h4>What MCME rank does <b>not</b> lead jobs?<span class='notice'>* </span></h4> 
<div class='element'><input name="job" type="radio" value="0">Foreman</div>
<div class='element'><input name="job" type="radio" value="1">Builder</div>
<div class='element'><input name="job" type="radio" value="2">Designer</div>
<h4>Is generating new terrain acceptable?<span class='notice'>* </span></h4> 
<div class='element'><input name="terrain" type="radio" value="0">Yes</div>
<div class='element'><input name="terrain" type="radio" value="1">No</div>
<hr/>
<h2>Confirm & Submit</h2>
<div class='draw'>Is this you?
<br/>
<img id='facecontain'></img>
<span class='subtit' id='warn' stlye='width:64px;'>This text will be replaced with an image of your skin once you enter a username above.</span>
<br/>
If this is not you, you should check your username above.</div>
<br/>
<div class='draw'><input name="tos" type="checkbox" value="1"><span class='subtit'>By checking this box, you agree to the <a href="http://mcme.co/terms-of-service/" target="_blank">Minecraft Middle-Earth Terms of Service</a>, and the <a href="http://mcme.co/rules/" target="_blank">Minecraft Middle-Earth Server Rules</a></span>
<input type="hidden" name="type" value="submit"><input type="submit" value="Submit" /><br/>
<span class='notice'>* </span><span class='subtit'>Marks required field</span></div>



</form>
</div>
<?php include(SCRIPTS."applyscript.inc.php"); ?>
</body>