<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<meta name="viewport" content="width=device-with,initial-scale=1">
<style>
.il{
	margin-top:5%;
}
body{
	font-family:Tahoma;
}
</style>
</head>
<body>
<center>
<h2>Login</h2>
<div class="cl">
<form action="" method="post">
<div class="il">
<label>Email or Username</label><br>
<input type="text" name="username"><br>
</div>
<div class="il">
<label>Password</label><br>
<input type="password" name="password"><br>
</div>
<div class="il" id="lbt">
<button type="submit" name="login">Login</button>
</div>
<input type="hidden" name="_token" value="{{{ csrf_token() }}}">
<input type="hidden" name="<?php print $ldt['ntoken'];?>" value="<?php print $ldt['vtoken'];?>">
<input type="hidden" name="vc" value="<?php print $ldt['vc'];?>">
</form>
</div>
</center>
</body>
</html>