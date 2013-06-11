<body>
<div class='container'>
<div class='loginelement'><?php echo $error; ?></div>
<br/>
<form method="POST" action="<?php echo OROOT; ?>">
  <div class='loginelement'>
    <label for='username'> "Username" <br/>
      <input type='text' name='username' id='username'>
    </label>
  </div>
  <br/>
  <div class='loginelement'>
    <label for='pass'> "Password" <br/>
      <input type='password' name='password' id='pass'>
    </label>
  </div>
  <input type='hidden' name='type' value='login'>
  <input type='submit'value='Login'>
</form>
</div>
</body>
