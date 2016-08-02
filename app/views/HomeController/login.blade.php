<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UNIAJC-Login</title>

    <!-- CSS -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/form-elements.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon"  type="image/png" href="http://www.uniajc.edu.co/images/favicon.ico"/>
    
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">

</head>
<script type="text/javascript">
  function nobackbutton(){   
    window.location.hash="no-back-button";   
   window.location.hash="Again-No-back-button" //chrome   
   window.onhashchange=function(){window.location.hash="no-back-button";}
} 

</script>
<body onload="nobackbutton();">

    <!-- Top content -->
    <div class="top-content">            
        <div class="inner-bg">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2 text">                            
                        <img src="images/logo_uniajc.png" alt="..." WIDTH=450, HEIGTH=350>
                        <div class="description">                               
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3 form-box">
                        <div class="form-top">
                            <div class="form-top-left">
                                <h3>Bienvenido.</h3>
                                <p>Ingresea tu correo y password para iniciar sesion.</p>
                                {{Session::get("messagee")}}
                                {{Session::get("message")}}


                            </div>
                            <div class="form-top-right">
                                <i class="fa fa-key"></i>
                            </div>
                        </div>
                        <div class="form-bottom">
                            <form role="form" action="login" method="post" class="form-group">
                                <div class="form-group">
                                    <div class="bg-danger">{{$errors->first('email')}}</div>
                                    <label class="sr-only" for="email">Email</label>
                                    <input type="text" name="email" placeholder="Email..." class="form-username form-control" id="email">
                                </div>
                                <div class="form-group">
                                    <div class="bg-danger">{{$errors->first('password')}}</div>
                                    <label class="sr-only" for="password">Password</label>
                                    <input type="password" name="password" placeholder="Password..." class="form-password form-control" id="password">
                                </div>
                                <div class="form-group">
                                   {{Form::label("Recordar sesión:")}}
                                   {{Form::input("checkbox", "remember", "On")}}
                               </div>
                               {{Form::input("hidden", "_token", csrf_token())}}
                               <button type="submit" class="btn btn-primary btn-md">Iniciar Sesion</button>
                               
                           </form>
                       </div>
                   </div>
               </div>

               <div class="row">
                <div class="col-sm-6 col-sm-offset-3 social-login">
                    <h3>Siguenos en</h3>
                    <div class="social-login-buttons">
                        <a class="btn btn-link-1 btn-link-1-facebook"  title="UNIAJC en Facebook" onclick="window.open('https://www.facebook.com/UNIAJC', '_blank');">
                            <i class="fa fa-facebook"></i> Facebook
                        </a>
                        <a class="btn btn-link-1 btn-link-1-twitter" title="UNIAJC en Twitter"
                        onclick="window.open('https://twitter.com/uniajc/', '_blank');">
                        <i class="fa fa-twitter"></i> Twitter
                    </a>
                    <a class="btn btn-link-1 btn-link-1-google-plus" title="UNIAJC en Google+"
                    onclick="window.open('https://plus.google.com/101760834130837627007/posts', '_blank');">
                    <i class="fa fa-google-plus"></i> Google Plus
                </a>
            </div>
        </div>
    </div>
</div>
</div>

</div>


<!-- Javascript -->
<script src="assets/js/jquery-1.11.1.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/js/jquery.backstretch.min.js"></script>
<script src="assets/js/scripts.js"></script>

        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
            <![endif]-->

        </body>

        </html>



        
        



        






