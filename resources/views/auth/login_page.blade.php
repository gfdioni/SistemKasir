<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta property="og:title" content="Login">
    <meta property="og:description" content="Login">
    <meta name="description" content="Login">
    <meta name="csrf-token" content="{{{ csrf_token() }}}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <script src="/js/jquery-3.2.1.min.dev.js"></script>
    <script type="text/javascript">
    /**
    * @author Ammar Faizi <ammarfaizi2@gmail.com>
    */
    function login(){$.post("login/action",{username: $("#u").val(),password: $("#p").val(),_token: "{{ csrf_token() }}"},function(data,status){if(status=='success'){if(typeof data.alert!='undefined'){alert(data.alert);}if(typeof data.redirect!='undefined'){window.location = data.redirect;}console.log(data);}})}; 
    </script>
</head>    
<body>
<center>
<div class="cgu" id="dg">
    <div class="cg2">
        <div class="htr"><h3>Login Kasir</h3></div>
        <form action="#">
        <div class="lin">
            <label>Username :</label>
        </div>
        <div class="in">
            <input type="text" required name="username" size="28" id="u">
        </div>
        <div class="lin">
            <label>Password :</label>
        </div>
        <div class="in">
            <input type="password" required name="password" size="28" id="p">
        </div>
        <div class="insb">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button type="button" id="sbbt" onclick="login();">Login</button>
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