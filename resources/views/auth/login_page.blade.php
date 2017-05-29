<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta property="og:title" content="Login">
    <meta property="og:description" content="Login">
    <meta name="description" content="Login">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/login.css">
</head>    
<body>
<center>
<div class="cgu" id="dg">
    <div class="cg2">
        <div class="htr"><h3>Login Kasir</h3></div>
        <form action="" method="post">
        <div class="lin">
            <label>Username :</label>
        </div>
        <div class="in">
            <input type="text" required name="username"size="28">
        </div>
        <div class="lin">
            <label>Password :</label>
        </div>
        <div class="in">
            <input type="password" required name="password" size="28">
        </div>
        <div class="insb">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="submit" name="login" value="Login" id="sbbt">
        </div>
        </form>
        <div class="rgcg">
            <p>Belum punya akun ?</p>
            <a href="/register"><button class="rgbutton">Daftar</button></a>
        </div>
    </div>
</div>
</center>
</body>
</html>