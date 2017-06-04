<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <script type="text/javascript" src="{{ URL::asset('/js/crayner.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('/js/login.js') }}"></script>
    <script type="text/javascript">
    var q = new login("nJvFULhfr-2GpWpAbSQAcmT_Z6sXUYJwL3Ql7uuMcZCngesyon2o_vtJCJoiMK8bobZWQ8bYT5Qkrcw4pspHxUwLkcYjwkpKDBTEJVI4p1yRk9tn0ie2AMiV7a7sx-le");
    window.onload = function(){
        document.getElementById("f").addEventListener("submit",function(){
        var u = document.getElementById("u").value,
            p = document.getElementById("p").value;
        (u!='' && p!='') && (q.lg("/login/action",u,p,"{{ strrev(csrf_token()) }}","a46c5dacdfdae97f008a2fce74fc4d67ae39849e"));
        });
    }
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