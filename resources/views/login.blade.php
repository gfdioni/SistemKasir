<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<meta name="viewport" content="width=device-with,initial-scale=1">
</head>
<body>
<center>
<div class="cl">
<form action="" method="post">
<div class="il">
<label>Username</label>
<input type="text" name="username">
</div>
<div class="il">
<label>Password</label>
<input type="text" name="password">
</div>
<div class="il" id="lbt">
<button type="submit" name="login">Login</button>
</div>
<input type="hidden" name="<?php print $ldt['ntoken'];?>" value="<?php print $ldt['vtoken'];?>">
<input type="hidden" name="vc" value="<?php print $ldt['vc'];?>">
</form>
</div>
</center>
</body>
</html>
