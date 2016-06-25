@if(Auth::check())

<!DOCTYPE html>
<html lang="es">
 
<head>
      <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <!-- BOOTSTRAP STYLES-->


  @include('includes.styles2')

</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
        @include('includes.header')
        @include('includes.sidebar')
      </nav>  
        
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                    
                     </div>
                </div>           
                 

</body>

</html>
    @endif