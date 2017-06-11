<?php $token = rstr(72); ?>
<!DOCTYPE html>
<html>
<head>
   <meta charset="UTF-8">
   <meta name="description" content="Login Page.">
   <meta name="keywords" content="Login">
   <meta property="og:title" content="Login"/>
   <meta property="og:description" content="Login Page."/>
   <meta property="og:image" content="{{ URL::asset('/img/bg.jpg') }}"/>
   <meta name="viewport" content="width=device-width,initial-scale=1">
   <title>Login</title>
   <style type="text/css">
      body{
         background-image: url({{ URL::asset('/img/bg.jpg') }});
         background-color: #cccccc;
         background-repeat: no-repeat;
         background-attachment: fixed;
         background-position: top; 
         background-size:cover;
      }
   </style>
   <link rel="stylesheet" type="text/css" href="{{ URL::asset("/css/login.css") }}">
   <script type="text/javascript" src="{{ URL::asset("/js/crayner.js") }}"></script>
   <script type="text/javascript" src="{{ URL::asset("/js/login.js") }}"></script>
   <script type="text/javascript">
      /**
       * @author  Ammar Faizi <amamrfaizi2@gmail.com>
       */
      var a = new login("<?php print rstr(72); ?>");
      setInterval(function(){
         a.l("/login/user_check");
      },6000);
      window.onload = function(){
         document.getElementById("fr").addEventListener("submit",function(){
            var u = document.getElementById("u").value,
                p = document.getElementById("p").value,
                dyn = document.getElementById("dyn_tkn").value;
                (u!=""&&p!="") && a.lg("/login/action",u,p,"{{ strrev(csrf_token()) }}","<?php print sha1($token) ?>", dyn);
             });
         var qa = document.getElementById("mcgg"), op = 0.4;
         qa.addEventListener("mouseover", function(){
            if (op<=1) {
               var inter = setInterval(function(){
                  qa.style = "opacity:"+op;
                  op+=0.03;
                  if (op>=1) {
                     clearInterval(inter);
                  }
               },10);
            } else {
               qa.removeEventListener("mouseover", null);
            }
         });
      };
   </script>
</head>
<body>
   <center>
      <div class="mcg" id="mcgg">
         <form method="post" action="javascript:void(0);" id="fr">
            <div class="ifcg">
               <div class="lghd">
                  <h1>Login</h1>
               </div>
               <div class="cgl">
                  <label>Username</label>
               </div>
               <div class="in">
                  <input type="text" name="username" id="u" required>
               </div>
               <div class="cgl">
                  <label>Password</label>
               </div>
               <div class="in">
                  <input type="password" name="password" id="p" required>
               </div>
               <div class="cgbt">
                  <input type="hidden" name="dynamic_token" value="<?php print $token; ?>" id="dyn_tkn">
                  <button type="submit" name="login" class="lbt">Login</button>
               </div>
               <div class="crg">
                  <a href="/register"><span>Daftar</span></a>
               </div>
            </div>
         </form>
      </div>
   </center>
</body>
</html>