<!DOCTYPE html>
<html lang="en">
  <head>


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{URL::to('/')}}bootstrap/css/bootstrap.theme.min.css">
    <script type="text/javascript" src="{{URL::to('/')}}bootstrap/js/jquery.js"></script>
    <script type="text/javascript" src="{{URL::to('/')}}bootstrap/js/bootstrap.min.js"></script>
    <script src="bootstrap/tabla/js/jquery.js"></script>
    <script src="bootstrap/tabla/js/bootstrap.min.js"></script>
    <script src="bootstrap/js/efecto.js"></script>
    <link href="bootstrap/vis/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/vis/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

   
    @include('layouts.Estilo')

    
 
  </head>  
  <body>
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
              
            
          </ul>
       @if(Auth::user()->get())
          <ul class="nav navbar-right top-nav">
            <a class="navbar-brand" >Bienvenido,{{Auth::user()->get()->nombre}} {{Auth::user()->get()->apellido}} </a>          
          <a href="{{URL::route('salir')}}">
                {{Form::label("Salir", null, array('class' => 'btn btn-success'))}}
                {{Form::close()}}
          </a>
         @endif            
            </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
    <div class="container" style='margin-top: 80px'>

    {{Session::get("message")}}
      <div class="bg-danger"> {{$errors->first('email')}}</div>
      <div class="bg-danger"> {{$errors->first('password')}}</div>
 


 <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                <li class="text-center">
                    <img src="assets/img/find_user.png" WIDTH=300 HEIGHT=600 class="user-image img-responsive">
                    </li>              
                    <li>
                        <a class="active-menu" href="<?=URL::to('notificaciones');?>"><i class="fa fa-dashboard fa-3x"></i> NOTIFICACIONES</a>
                    </li>
                     <li>
                        <a href="ui.html"><i class="fa fa-desktop fa-3x"></i> PLAN DE CURSO</a>
                    </li>
                    <li>                    
                           <li>
                        <a href="chart.html"><i class="fa fa-bar-chart-o fa-3x"></i> REPORTES</a>
                    </li>   
                      <li>                       
               <br>  
</div><!-- /.container -->




<form novalidate="novalidate" class="form-horizontal bv-form" id="contactform2" name="commentform" method="post" action="login" data-bv-message="This value is not valid" data-bv-feedbackicons-valid="glyphicon glyphicon-ok" data-bv-feedbackicons-invalid="glyphicon glyphicon-remove" data-bv-feedbackicons-validating="glyphicon glyphicon-refresh">
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Loggin</h4>
      </div>
      <div class="modal-body">        

             <div class="form-group has-feedback has-success">
                    <label class="control-label col-md-4" for="email">Email:</label>
                    <div class="col-md-6">
                        <input data-bv-field="email" class="form-control" id="email" name="email" placeholder="Email Address" data-bv-notempty="" data-bv-notempty-message="Email es obligatorio" type="email"><i data-bv-icon-for="email" class="form-control-feedback glyphicon glyphicon-ok" style="display: block;"></i>
                    <small data-bv-result="VALID" data-bv-for="email" data-bv-validator="emailAddress" class="help-block" style="display: none;">Ingrese un Email Valido</small><small data-bv-result="VALID" data-bv-for="email" data-bv-validator="notEmpty" class="help-block" style="display: none;">El correo Electronico Es Obligatorio</small></div>
                </div>

             <div class="form-group has-feedback has-success">
             <label class="control-label col-md-4" for="password">Password:</label>
             <div class="col-md-6">
             <input data-bv-field="password" class="form-control" id="password" name="password" placeholder="password" data-bv-notempty="" data-bv-notempty-message="Ingrese el Password" type="password"><i data-bv-icon-for="password" class="form-control-feedback glyphicon glyphicon-ok" style="display: block;"></i>
             <small data-bv-result="VALID" data-bv-for="password" data-bv-validator="notEmpty" class="help-block" style="display: none;">Ingrese el Password</small></div> 
             </div>

             <div class="form-group has-feedback has-success">
             <label class="control-label col-md-4" for="remember">Recordar sesión:</label>
             <div class="col-md-6">
             <input class="form-control" type="checkbox"></i>
             <div class="bg-danger">{{$errors->first('nombre')}}</div>
             <small data-bv-result="VALID" data-bv-for="remember" data-bv-validator="notEmpty" class="help-block" style="display: none;">Ingrese el Password</small></div> 
             </div>

             <div class="form-group has-feedback has-success">          
             
             </div>           


            
          <div class="modal-footer">
          {{Form::input("hidden", "_token", csrf_token())}}
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <input value="Submit" data-bv-submit-hidden="" type="hidden"></form>
            <button disabled="disabled" type="submit" value="Submit" class="btn btn-custom pull-right" id="send_btn">Send</button>
    </form>
      </div>
    </div>
  </div>
</div>

<style>
.modal {
position: fixed;
right: o;
top: 40px;
}
.modal-header,
.btn-custom {
    background: #1ABC9C;
    color: #FFF;
}
.modal-body {
    background: #73BFC1;
}
.popover   {
    background-color: #e74c3c;
    color: #ecf0f1;
    width: 120px;
}
.popover.right .arrow:after {
    border-right-color: #e74c3c;
}
.input-group[class*="col-"] {
    padding-right: 15px;
    padding-left: 15px;
}
</style>
 

<script>
$('#contactform2').bootstrapValidator();
</script>

</div>
</div>
</div>
</div>

  </body>


  
</html>



