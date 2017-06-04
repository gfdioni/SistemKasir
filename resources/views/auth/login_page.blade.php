<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <script type="text/javascript" src="{{ URL::asset('/js/crayner.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('/js/login.js') }}"></script>
    <script type="text/javascript">
        
    </script>
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('/css/login.css') }}">
    <style type="text/css">
        /*background-image: url(); */
        background-color: #cccccc;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-position: top; 
    </style>
</head>
<body>
<center>
<div class="cgu" id="dg">
    <div class="cg2">
        <div class="htr"><h3>Login</h3></div>
        <form id="f" action="javascript:void(0);" method="post">
        <div class="lin">
            <label>Username :</label>
        </div>
        <div class="in">
            <input type="text" id="u" name="username" size="28" required>
        </div>
        <div class="lin">
            <label>Password :</label>
        </div>
        <div class="in">
            <input type="password" id="p" name="password" size="28" required>
        </div>
        <div class="insb">
            <input type="submit" name="login" value="Login" id="b">
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