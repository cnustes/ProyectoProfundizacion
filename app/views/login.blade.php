<!DOCTYPE html>
        <html lang="es"><head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <title>UNIAJC- Login</title>
		<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <link rel="shortcut icon"  type="image/png" href="http://www.uniajc.edu.co/images/favicon.ico" />
 
        @include('includes.styles')
	     </head>    
         <body>
        <div id="container">
            <div id="logo">
                <img src="img/logo.png" alt="">
            </div>
            <div id="loginbox">  
            <form  action="login" method="post">﻿
            @if (Session::has('login_errors')) 
            <p style='color:#FB1D1D'>El nombre de usuario o la contraseña no son Correctos.</p>         
               
               @else
    				<p>Introduzca usuario y contraseña para continuar.</p>
                    @endif
                    <div class="input-group input-sm">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span><input class="form-control" id="username" placeholder="Usuario" type="text" name="username">
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span><input class="form-control" id="password" placeholder="Contraseña" type="password" name="password">
                    </div>
                    <div class="form-actions clearfix">                      
                <input class="btn btn-block btn-primary btn-default" value="Acceder" type="submit">
                    </div>
                    <div class="footer-login">
                        <div class="pull-center text">
                            ¡BIENVENIDO!
                           
                        </div>
                        
                    </div>
                </form>



                </div>
                <div class="margin text-center">
            <button jquery_tooltip
                    class="btn bg-green btn-circle"
                    title="Página Web de la UNIAJC"
                    onclick="window.open('http://uniajc.edu.co/', '_blank');">
                <i class="fa fa-home"></i>
            </button>
            <button jquery_tooltip
                    class="btn bg-light-blue btn-circle"
                    title="UNIAJC en Facebook"
                    onclick="window.open('https://www.facebook.com/UNIAJC', '_blank');">
                <i class="fa fa-facebook"></i>
            </button>
            <button jquery_tooltip
                    class="btn bg-aqua btn-circle"
                    title="UNIAJC en Twitter"
                    onclick="window.open('https://twitter.com/uniajc/', '_blank');">
                <i class="fa fa-twitter"></i>
            </button>
            <button jquery_tooltip
                    class="btn bg-red btn-circle"
                    title="UNIAJC en Google+"
                    onclick="window.open('https://plus.google.com/101760834130837627007/posts', '_blank');">
                <i class="fa fa-google-plus"></i>
            </button>
        </div>
        <script src="js/jquery.js"></script>  
        <script src="js/jquery-ui.js"></script>
        <script src="js/login.js"></script> 


</body>
</html>