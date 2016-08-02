@extends('layouts.master')

@section('title')
Inicio
@stop
@include('includes.styles')

@section('content')
<body>
  <div class="input-group">
   @if (Session::has('message'))
   <div class="alert alert-success" id="success-alert">
    <button type="button" class="close" data-dismiss="alert">x</button>
    <strong>{{Session::get("message")}}</strong>  
  </div>
  @endif

  @if (Session::has('mensaje'))
  <div class="alert alert-danger" id="success-alert">
    <button type="button" class="close" data-dismiss="alert">x</button>
    <strong>{{Session::get("mensaje")}}</strong>  
  </div>
  @endif

  @if(HTML::ul($errors->all()))
  <div class="alert alert-danger" id="success-alert">
    <button type="button" class="close" data-dismiss="alert">x</button>
    <strong>Se encontraron los siguientes Errores:</strong>
    <P>                  
      <strong>{{$errors->first('tema_id')}}</strong>       
      <P>
        <strong>{{$errors->first('hora')}}</strong>         
        <P>
          <strong>{{$errors->first('semana')}}</strong>        
          <P>
            <strong>{{$errors->first('firma_docente')}}</strong> 
            <P>                   
              <strong>{{$errors->first('firma_vocero')}}</strong> 
              <P>
                <strong>{{$errors->first('observacion_docente')}}</strong> 
                <P>                      
                  <strong>{{$errors->first('observacion_vocero')}}</strong> 
                  <P>
                    <strong>{{$errors->first('fecha_sesion')}}</strong> 
                    <P>
                    </div>

                    @endif

                  </div>
                  <script type="text/javascript">
                   $(document).ready (function(){                               
                    $("#success-alert").hide(); 
                    $("#success-alert").alert();
                    $("#success-alert").fadeTo(4500, 500).slideUp(500, function(){
                     $("#success-alert").alert('close');

                   });  
                  }); 

                </script>
                <table class="table table-striped table-bordered table-hover dataTable no-footer" id="userss" aria-describedby="dataTables-example_info">
                  <div class="col-lg-12">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <div class="panel-body">
                          <div class="table-responsive">
                            <h1><center><b><font size ="3", color="#53a4ee" face="Arial Black">AQUÍ VERAS TODOS LOS GRUPOS DONDE ERES VOCERO.</center></font></b></h1>
                          </div>
                          <thead>             
                            <div class="input-group"> <span class="input-group-addon">Filtro:</span>
                              <input id="filter" type="text" class="form-control" placeholder="Filtrar Por...">
                              <tr>                
                                <th>Nombre Grupo</th>
                                <th>Nombre Asignatura</th>
                                <th>Opciones</th>
                              </tr>
                            </thead>
                            <tbody class="searchable" id="myTable">
                              <tr>

                                @if($resultado)
                                <!--asignamos a un bucle de array $users a $user-->
                                @foreach($resultado as $key => $user)
                                <form action="/qualityteam/public/reporteDiario" method="POST">
                                  <input type="hidden" name="asignacion_id" value="{{ $user->asignatura->programa_id }}">
                                  <td><b><font size ="3", color ="#016cdf">{{ $user->grupo->nombre_grupo}}</font></b></td>
                                  <td><b><font size ="3", color ="#016cdf">{{ $user->asignatura->nombre_asignaturas}}</font></b></td>
                                  <td>
                                    <!-- <button type="submit" class="fa fa-arrow-right"> -->
                                    <!-- </button> -->
                                    <a title="Reporte Diario" class="btn btn-info fa fa-arrow-right" href="{{ URL::to('reporteDiario/' . $user->asignatura->programa_id ) }}"></a>
                                  </td>
                                </form>
                              </tr>
                              @endforeach
                            </tbody>
                          </table>          
                          <div class="col-md-12 text-center">
                            <ul class="pagination pagination-lg pager" id="myPager"></ul>
                          </div>
                        </td>
                      </tr>
                      @endif
                      <script type="text/javascript">
                        $(document).ready(function () {
                          (function ($) {
                            $('#filter').keyup(function () {
                              var rex = new RegExp($(this).val(), 'i');
                              $('.searchable tr').hide();
                              $('.searchable tr').filter(function () {
                                return rex.test($(this).text());
                              }).show();

                            })

                          }(jQuery));

                        }); 
                      </script>

                      <script type="text/javascript">
                        $.fn.pageMe = function(opts){
                          var $this = this,
                          defaults = {
                            perPage: 7,
                            showPrevNext: false,
                            hidePageNumbers: false
                          },
                          settings = $.extend(defaults, opts);

                          var listElement = $this;
                          var perPage = settings.perPage; 
                          var children = listElement.children();
                          var pager = $('.pager');

                          if (typeof settings.childSelector!="undefined") {
                            children = listElement.find(settings.childSelector);
                          }

                          if (typeof settings.pagerSelector!="undefined") {
                            pager = $(settings.pagerSelector);
                          }

                          var numItems = children.size();
                          var numPages = Math.ceil(numItems/perPage);

                          pager.data("curr",0);

                          if (settings.showPrevNext){
                            $('<li><a href="#" class="prev_link">«</a></li>').appendTo(pager);
                          }

                          var curr = 0;
                          while(numPages > curr && (settings.hidePageNumbers==false)){
                            $('<li><a href="#" class="page_link">'+(curr+1)+'</a></li>').appendTo(pager);
                            curr++;
                          }

                          if (settings.showPrevNext){
                            $('<li><a href="#" class="next_link">»</a></li>').appendTo(pager);
                          }

                          pager.find('.page_link:first').addClass('active');
                          pager.find('.prev_link').hide();
                          if (numPages<=1) {
                            pager.find('.next_link').hide();
                          }
                          pager.children().eq(1).addClass("active");

                          children.hide();
                          children.slice(0, perPage).show();

                          pager.find('li .page_link').click(function(){
                            var clickedPage = $(this).html().valueOf()-1;
                            goTo(clickedPage,perPage);
                            return false;
                          });
                          pager.find('li .prev_link').click(function(){
                            previous();
                            return false;
                          });
                          pager.find('li .next_link').click(function(){
                            next();
                            return false;
                          });

                          function previous(){
                            var goToPage = parseInt(pager.data("curr")) - 1;
                            goTo(goToPage);
                          }

                          function next(){
                            goToPage = parseInt(pager.data("curr")) + 1;
                            goTo(goToPage);
                          }

                          function goTo(page){
                            var startAt = page * perPage,
                            endOn = startAt + perPage;

                            children.css('display','none').slice(startAt, endOn).show();

                            if (page>=1) {
                              pager.find('.prev_link').show();
                            }
                            else {
                              pager.find('.prev_link').hide();
                            }

                            if (page<(numPages-1)) {
                              pager.find('.next_link').show();
                            }
                            else {
                              pager.find('.next_link').hide();
                            }

                            pager.data("curr",page);
                            pager.children().removeClass("active");
                            pager.children().eq(page+1).addClass("active");

                          }
                        };

                        $(document).ready(function(){

                          $('#myTable').pageMe({pagerSelector:'#myPager',showPrevNext:true,hidePageNumbers:false,perPage:5});

                        }); 

                      </script>


                      @stop