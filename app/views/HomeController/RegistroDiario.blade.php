@if($asignacion)

<?php
date_default_timezone_set('America/Bogota');


?>
@extends('layouts.master2')
@include('includes.styles2')

@section('title')
Registro Sesion
@stop

@section('content')
<table class="table table-striped table-bordered table-hover dataTable no-footer" id="userss" aria-describedby="dataTables-example_info">
  <div class="col-lg-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <div class="panel-body">
          <div class="table-responsive">
            @if($perfil_logueado=Auth::user()->get()->perfil_id==2)
            <h1><center><b><font size ="3", color="#53a4ee" face="Arial Black">AQUÍ VERAS TODAS LAS SESIONES DE GRUPOS DONDE ERES DOCENTE.</center></font></b></h1>
            @elseif($perfil_logueado=Auth::user()->get()->perfil_id==3)
            <h1><center><b><font size ="3", color="#53a4ee" face="Arial Black">AQUÍ VERAS TODAS LAS SESIONES DE GRUPOS DONDE ERES VOCERO.</center></font></b></h1>
            @endif
          </div>
          <thead>
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
                          <div class="input-group"> 
                            @if($perfil_logueado=Auth::user()->get()->perfil_id==2)                          
                            
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal_Registrar_Sesion">
                             <strong> <font size ="2", color ="#01080f"><span> Nueva Sesión</span> </font></strong>
                             <strong> <font size ="2", color ="#01080f"><span class="fa fa-file-o"></span></font></strong>
                           </button>
                           @endif
                         </div>
                         <div class="input-group"> <span class="input-group-addon">Filtro:</span>
                          <input id="filter" type="text" class="form-control" placeholder="Filtrar Por...">
                        </div>
                        <tr>               
                         <th>Hora</th>
                         <th>Tema</th>               
                         <th>Firma Docente</th>
                         <th>Firma Vocero</th>                                          
                         <th>Opciones</th>
                       </tr>
                     </thead>
                     <tbody class="searchable" id="myTable">
                      <tr>              
                        <!--asignamos a un bucle de array $users a $user-->
                        @foreach($sesiones as $key => $value)              
                        <td><b><font size ="2", color ="#016cdf">{{ $value->created_at->diffForHumans()}}</font></b></td>
                        <td><b><font size ="2", color ="#016cdf">{{ $value->tema->nombre_tema }}</font></b></td>              
                        <td><b><font size ="2", color ="#016cdf">{{ Form::checkbox('checkbox1', 'null',$value->firma_docente, ['class'=>'checkbox'] )}}</font></b></td>
                        <td><b><font size ="2", color ="#016cdf">{{ Form::checkbox('checkbox2', 'null',$value->firma_vocero, ['class'=>'checkbox'] )}}</font></b></td>
                        <td>
                          {{ Form::open(array('url' => 'users/' . $value->id, 'class' => 'pull-rigth')) }}

                          
                          <!-- Ver Sesion -->
                          <a href="#myModal_Vista_Previa" data-toggle = 'modal' id="{{$value->id}}" class="ver_sesion">
                            <button class="btn-warning btn-social" type="button"></font></strong>
                             <strong> <font size ="2", color ="#01080f"> <span class= "fa fa-eye"></span> </strong>
                             <strong> <font size ="2", color ="#01080f">  <span> Ver Sesión</span> </font></strong>
                           </button>
                         </a>
                         @if($perfil_logueado=Auth::user()->get()->perfil_id==2) 
                         <!-- Editar Sesion -->
                         <a href="#myModal_Editar_Sesion" data-toggle = 'modal' id="{{$value->id}}" class="editar_sesion">
                          <button class="btn-info" type="button">
                            <strong> <font size ="2", color ="#01080f"><span class="fa fa-pencil-square-o"></span></font></strong>
                            <strong> <font size ="2", color ="#01080f"><span> Editar Sesión</span> </font></strong>
                          </button>
                        </a>
                        @endif
                        @if($perfil_logueado=Auth::user()->get()->perfil_id==3) 
                        <!-- Firmar Sesion -->
                        <a href="#myModal_Registrar_Firma" data-toggle = 'modal' id="{{$value->id}}" class="firmar_sesion">
                          <button class="btn-success btn-social" type="button">
                            <strong><font size ="2", color ="#01080f"><span class= "fa fa-pencil"></span></font></strong>
                            <strong> <font size ="2", color ="#01080f"><span> Firmar Sesión</span> </font></strong>
                          </button>
                        </a>
                        @endif
                        {{ Form::close() }}
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>          
                <div class="col-md-12 text-center">
                  <ul class="pagination pagination-lg pager" id="myPager"></ul>
                </div>
              </td>
            </tr>


            <!-- Modal Registrar Sesion -->
            <div class="panel-body">                        
             <div class="modal fade" id="myModal_Registrar_Sesion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="limpiarCampos_NuevaSesion()"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Registrar - Nueva Sesión</h4>
                  </div>
                  <div class="modal-body">

                    <div class="panel-body">

                      {{Form::open(array(
                      "method" => "POST",
                      "action" => "registroDiario",
                      "role" => "form",
                      "id"  => "formulario_sesion",
                      ))}}

                      <div class="row">
                        <div class="form-group ">
                          {{Form::input("hidden", "asignacion_id", $asignacion->asignatura_id)}}   
                          {{Form::input("hidden", "fecha_sesion", date('m-d-y'))}}                        
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-sm-5">
                          <font size ="2", color ="#000000">{{Form::label("FACULTAD:")}}</font>
                          <font size ="2", color ="#016cdf">{{Form::label($asignacion->facultad->nombre_facultades)}}</font>
                          <div class="bg-danger">{{$errors->first('titulo')}}</div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-sm-5">
                          <font size ="2", color ="#000000">{{Form::label("DOCENTE:")}}</font>
                          <font size ="2", color ="#016cdf">{{Form::label($asignacion->persona->nombre_user)}}</font>
                          <div class="bg-danger">{{$errors->first('titulo')}}</div>
                        </div>
                        <div class="form-group col-sm-5">
                          <font size ="2", color ="#000000">{{Form::label("MATERIA:")}}</font>
                          <font size ="2", color ="#016cdf">{{Form::label($asignacion->asignatura->nombre_asignaturas)}}</font>
                          <div class="bg-danger">{{$errors->first('titulo')}}</div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-sm-5">
                          <font size ="2", color ="#000000">{{Form::label("PERIODO:")}}</font>
                          <font size ="2", color ="#016cdf"> {{Form::label($asignacion->periodo)}}</font>
                          <div class="bg-danger">{{$errors->first('titulo')}}</div>
                        </div>
                        <div class="form-group col-sm-5">
                         <font size ="2", color ="#000000"> {{Form::label("GRUPO:")}}</font>
                         <font size ="2", color ="#016cdf"> {{Form::label($asignacion->grupo->nombre_grupo)}}</font>
                         <div class="bg-danger">{{$errors->first('titulo')}}</div>
                       </div>
                     </div>  
                     <div class="form-group ">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}" id="_token">
                      <font size ="3", color ="#000000">{{Form::label("Seleccione un tema: ")}}</font>
                      <font size ="3", color ="#000000">{{Form::select('tema_id', $nombre_temas, null, array('id'=>'nombre_tema', 'onchange'=>'filtrarMaterias()'))}}</font>
                    </div>


                    <div class="form-group ">                      
                      <font size ="3", color ="#000000">{{Form::label("Semana: ")}}</font>
                      <input type="text" class="form-control" id="semana_tema"  name="semana_tema"> 

                    </div>  

                    <div class="form-group">
                     <font size ="2", color ="#000000"> {{Form::label("TEMA ADICIONAL:")}}</font>                      
                     <input type="text" id="tema_adicional" name="tema_adicional" class="form-control">

                     <div class="bg-danger">{{$errors->first('titulo')}}</div>
                   </div>
                   <div class="form-group">
                     <font size ="2", color ="#000000"><label>CANTIDAD HORAS:</label></font>
                     <select id="hora" name="hora" class="form-control">  
                       <option value="">Porfavor Selecciona la cantidad de horas</option>                  
                       <option value="1">1 HORA</option>  
                       <option value="2">2 HORAS</option>
                       <option value="3">3 HORAS</option>
                       <option value="4">4 HORAS</option>
                       <option value="5">5 HORAS</option>   
                     </select>
                   </div>


                   <div class="form-group">
                     <font size ="2", color ="#000000"> {{Form::label("Firma Docente:")}}</font>
                     <font size ="2", color ="#016cdf"> {{Form::input("checkbox", "firma_docente", 1,array('id'=>'firma_docente'))}}</font>
                   </div>

                   <div class="form-group">
                     <font size ="2", color ="#000000"> {{Form::label("Observaciones:")}}            
                       <font size ="2", color ="#016cdf"> {{Form::textarea("observacion_docente", null, array("class" => "form-control" ,'id'=>'observacion_docente'))}}</font>
                     </div>           
                   </div>
                   <div class="panel-footer">Registrando Reporte Diario</div>

                 </div>
                 <div class="modal-footer">
                   <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="limpiarCampos_NuevaSesion()">Cancelar</button>
                   <a class="btn btn-primary" data-toggle="modal" data-target="#confirm-delete">Guardar Sesion</a><br>                           
                 </div>
               </div>
             </div>
           </div>
           <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">

                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title" id="myModalLabel">Confirmacion Crear Sesion</h4>
                </div>

                <div class="modal-body">
                  <p>¿Está seguro de crear la sesión? </p>
                  <p> Después de esto no hay vuelta atrás.</p>
                  <p>Esperando Confirmación...</p>
                  <p class="debug-url"></p>
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                  <button  class="btn btn-primary" data-toggle="modal" data-target="#confirm-delete">Guardar Sesion</button>

                </div>
              </div>
            </div>
            {{Form::close()}}

          </div>

          <script type="text/javascript">
            function filtrarMaterias(){
              var $el = $("#semana_tema");
    $el.empty(); // remove old options
    $.post("/qualityteam/public/temas",
    {
      id: $('#nombre_tema').val(),
      _token: $('#_token').val()
    },
    function(data, status){
          // alert("Data: " + data + "\nStatus: " + status);
          var tema = [];
          for (var i = 0; i < data.length; i++) {
            tema.push(data[i].semana);
          };

          $.each(tema, function(key,value) {

            $el.append($('#formulario_sesion input[name="semana_tema"]').attr("value", key).val(value));

          });

          // console.log(temas);
        });

  }
</script>

<!-- Aqui viene el modal Firmar vocero-->

<div class="panel-body">
 <!-- Modal -->
 <div class="modal fade" id="myModal_Registrar_Firma" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="limpiarCampos()"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Firmar Sesion # @foreach($sesiones as $key => $value) {{ $value->id}}@endforeach</h4>
      </div>
      <div class="modal-body" id="formulario_sesion2">

        <div class="panel-body">
          {{ Form::model($asignacion, array('route' => array('GuardarFirma.update', $asignacion->id), 'method' => 'PUT')) }}

          <div class="row">
            <div class="form-group ">
              {{Form::input("hidden", "asignacion_id", $asignacion->asignatura_id)}}   
              {{Form::input("hidden", "fecha_sesion", date('m-d-y'))}}                        
            </div>
          </div>
          <div class="form-group">
            <font size ="2", color ="#000000"> {{Form::label("Firma Vocero:")}} 
              <input type="checkbox" id="firma_vocero" name="firma_vocero">
            </div>
            <div class="form-group">
             <font size ="2", color ="#000000"> {{Form::label("Observaciones:")}} 
               <textarea class="form-control" id="observacion_vocero" name="observacion_vocero" rows="10" >
               </textarea>
             </div>                                       
             <input type="hidden" class="form-control" id="exampleInputEmail1"  name="asignacion_id_edit">
             <input type="hidden" class="form-control" id="exampleInputEmail1"  name="hora_edit">
             <input type="hidden" class="form-control" id="exampleInputEmail1"  name="semana_edit">
             <input type="hidden" class="form-control" id="exampleInputEmail1"  name="tema_id_edit">
             <input type="hidden" class="form-control" id="exampleInputEmail1"  name="tema_adicional_edit">
             <input type="hidden" class="form-control" id="exampleInputEmail1"  name="estado_edit">
             <input type="hidden" class="form-control" id="exampleInputEmail1"  name="observacion_docente_edit">                                  
             <input type="hidden" class="form-control" id="exampleInputEmail1"  name="fecha_sesion_edit">
             <input type="hidden" class="form-control" id="exampleInputEmail1"  name="firma_docente_edit">                                   
             <input type="hidden" class="form-control" id="exampleInputEmail1"  name="created_at_edit"> 
             <input type="hidden" name="id_sesion">
           </div>           
         </div>
         <div class="panel-footer">Registrando Firma</div>

         <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="limpiarCampos()">Cancelar</button>

          <a class="btn btn-primary" data-toggle="modal" data-target="#confirm-delete2">Guardar Cambios</a><br>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="confirm-delete2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel">Confirmacion Crear Sesion</h4>
        </div>

        <div class="modal-body">
          <p>¿Está seguro de Guardar Cambios? </p>
          <p> Después de esto no hay vuelta atrás.</p>
          <p>Esperando Confirmación...</p>
          <p class="debug-url"></p>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
          <button  class="btn btn-primary" data-toggle="modal" data-target="#confirm-delete2">Guardar Sesion</button>

        </div>
      </div>
    </div>
    {{Form::close()}}
  </div>

  <!-- Aqui viene el modal Ver Sesion-->

  <div class="panel-body">
   <!-- Modal -->
   <div class="modal fade" id="myModal_Vista_Previa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="limpiarCampos()"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Vista Previa #</h4>
        </div>
        <div class="modal-body" id="formulario_sesion3">

          <div class="panel-body">                      
            <div class="row">
              <div class="form-group col-sm-5">
                <font size ="2", color ="#000000">{{Form::label("FACULTAD:")}}</font>
                <font size ="2", color ="#016cdf">{{Form::label($asignacion->facultad->nombre_facultades)}}</font>
                <div class="bg-danger">{{$errors->first('titulo')}}</div>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-sm-5">
                <font size ="2", color ="#000000">{{Form::label("DOCENTE:")}}</font>
                <font size ="2", color ="#016cdf">{{Form::label($asignacion->persona->nombre_user)}}</font>
                <div class="bg-danger">{{$errors->first('titulo')}}</div>
              </div>
              <div class="form-group col-sm-5">
                <font size ="2", color ="#000000">{{Form::label("MATERIA:")}}</font>
                <font size ="2", color ="#016cdf">{{Form::label($asignacion->asignatura->nombre_asignaturas)}}</font>
                <div class="bg-danger">{{$errors->first('titulo')}}</div>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-sm-5">
                <font size ="2", color ="#000000">{{Form::label("PERIODO:")}}</font>
                <font size ="2", color ="#016cdf"> {{Form::label($asignacion->periodo)}}</font>
                <div class="bg-danger">{{$errors->first('titulo')}}</div>
              </div>
              <div class="form-group col-sm-5">
               <font size ="2", color ="#000000"> {{Form::label("GRUPO:")}}</font>
               <font size ="2", color ="#016cdf"> {{Form::label($asignacion->grupo->nombre_grupo)}}</font>
               <div class="bg-danger">{{$errors->first('titulo')}}</div>
             </div>
           </div> 

           <div class="form-group ">
             <font size ="2", color ="#000000"> {{Form::label("FECHA SESION:")}}</font>
            <font size ="2", color ="#016cdf"><label name="fecha_Sesion_edit" id="fecha_Sesion_edit"></label></font>


           </div>

           <div class="form-group">
            <label for="semanaa">Tema:</label>                      
            <label type="text" class="form-control" id="nombre_tema" name="nombre_tema"></label>                            
          </div>
          <div class="form-group">
            <label for="semanaa">Tema Adicional:</label>
            <label type="text" class="form-control" id="tema_adicional_edit" name="tema_adicional_edit"></label>                      
          </div>
          <div class="form-group">
            <label for="Hora">Hora:</label>
            <label type="text" class="form-control" id="hora_edit" name="hora_edit"></label>                      
          </div>
          <div class="form-group">
            <label for="semanaa">Semana:</label>
            <label type="text" class="form-control" id="semana_edit" name="semana_edit"></label>                             
          </div>

          <div class="row">
            <div class="form-group col-sm-5">  
             <font size ="2", color ="#000000"> {{Form::label("Firma Docente:")}} </font>
             <input type="checkbox" id="firma_docente" name="firma_docente">                      

           </div>
           <div class="form-group col-sm-5"> 
             <font size ="2", color ="#000000"> {{Form::label("Firma Vocero:")}} </font>                       
             <input type="checkbox" id="firma_vocero" name="firma_vocero">
           </div>                                            
         </div>

         <div class="row">
          <div class="form-group col-sm-5">                        
           <font size ="2", color ="#000000"> {{Form::label("Observaciones Docente:")}} </font>
           <textarea class="form-control" id="observacion_docente_previa" name="observacion_docente_previa" rows="5" >
           </textarea>
         </div>
         <div class="form-group col-sm-5">                        
          <div class="form-group">
           <font size ="2", color ="#000000"> {{Form::label("Observaciones Vocero:")}} </font>
           <textarea class="form-control" id="observacion_vocero_previa" name="observacion_vocero_previa" rows="5" >
           </textarea>
         </div>                                       
       </div>
     </div>
   </div>           
 </div>
 <div class="panel-footer">Vista Previsa Sesion</div>

 <div class="modal-footer">
  <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="limpiarCampos()">Salir</button>
</div>
</div>
</div>
</div>
<div class="modal fade" id="confirm-delete2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">



      <script>
        $('#confirm-delete').on('show.bs.modal', function(e) {
          $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));

        });
      </script>



      <input id="val" type="hidden" name="id_asignacion" class="input-block-level" value="" >
      <script>
        $(document).ready(function() {
          $('.firmar_sesion').click(function() {
            $('[name=id_asignacion]').val($(this).attr ('id'));
            var faction = "<?php echo URL::to('reporteDiario/getsesiones/data'); ?>";
            var fdata = $('#val').serialize();
            $('#load').show();
            $.post(faction, fdata, function(json) {
              if (json.success) {     
                $('#formulario_sesion2 input[name="id_sesion"]').val(json.id);                                 
                $('#formulario_sesion2 input[name="asignacion_id_edit"]').val(json.asignacion_id);
                $('#formulario_sesion2 input[name="hora_edit"]').val(json.hora);
                $('#formulario_sesion2 input[name="semana_edit"]').val(json.semana);
                $('#formulario_sesion2 input[name="tema_id_edit"]').val(json.tema_id); 
                $('#formulario_sesion2 input[name="nombre_tema"]').val(json.nombre_tema);                                    
                $('#formulario_sesion2 input[name="tema_adicional_edit"]').val(json.tema_adicional);
                $('#formulario_sesion2 input[name="estado_edit"]').val(json.estado);
                $('#formulario_sesion2 input[name="observacion_docente_edit"]').val(json.observacion_docente);
                $('#formulario_sesion2 textarea[name="observacion_vocero_edit"]').text(json.observacion_vocero);                                         
                $('#formulario_sesion2 input[name="fecha_Sesion_edit"]').val(json.fecha_sesion);
                $('#formulario_sesion2 input[name="firma_docente_edit"]').val(json.firma_docente);                                      

                if(json.firma_vocero==true){
                 $('#formulario_sesion2 input[name="firma_vocero"]').prop('checked', true).checkbox(json.firma_vocero);

               }else{
                $('#formulario_sesion2 input[name="firma_vocero"]').prop('checked', false).checkbox(json.firma_vocero);

              }

              $('#formulario_sesion2 input[name="created_at_edit"]').val(json.created_at);
              $('#formulario_sesion2 input[name="updated_at_edit"]').val(json.updated_at); 
              console.log(json.firma_vocero);
            } else {
              $('#errorMessage').html(json.message);
              $('#errorMessage').show();
            }
          });
          });
        });
      </script>

      <!-- Ver sesion -->
      <input id="val" type="hidden" name="id_asignacion" class="input-block-level" value="" >
      <script>
        $(document).ready(function() {
          $('.ver_sesion').click(function() {
            $('[name=id_asignacion]').val($(this).attr ('id'));
            var faction = "<?php echo URL::to('reporteDiario/getsesiones/data'); ?>";
            var fdata = $('#val').serialize();
            $('#load').show();
            $.post(faction, fdata, function(json) {
              if (json.success) {     
                $('#formulario_sesion3 input[name="id_sesion"]').val(json.id);                                 
                $('#formulario_sesion3 input[name="asignacion_id_edit"]').val(json.asignacion_id);
                $('#formulario_sesion3 label[name="hora_edit"]').text(json.hora);
                $('#formulario_sesion3 label[name="semana_edit"]').text(json.semana);
                $('#formulario_sesion3 input[name="tema_id_edit"]').val(json.tema_id); 
                $('#formulario_sesion3 label[name="nombre_tema"]').text(json.nombre_tema);
                $('#formulario_sesion3 label[name="tema_adicional_edit"]').text(json.tema_adicional);                    
                $('#formulario_sesion3 textarea[name="observacion_docente_previa"]').text(json.observacion_docente);
                $('#formulario_sesion3 textarea[name="observacion_vocero_previa"]').text(json.observacion_vocero);
                $('#formulario_sesion3 label[name="fecha_Sesion_edit"]').text(json.fecha_sesion);

                if(json.firma_docente==true){
                 $('#formulario_sesion3 input[name="firma_docente"]').prop('checked', true);

               }else{
                $('#formulario_sesion3 input[name="firma_docente"]').prop('checked', false);
                            // $('#formulario_sesion2 input[name="firma_vocero"]').checkbox(json.firma_vocero);
                          }

                          if(json.firma_vocero==true){
                            $('#formulario_sesion3 input[name="firma_vocero"]').prop('checked', true);
                          }else{
                            $('#formulario_sesion3 input[name="firma_vocero"]').prop('checked', false);
                            // $('#formulario_sesion2 input[name="firma_vocero"]').checkbox(json.firma_vocero);
                          }

                          $('#formulario_sesion2 input[name="created_at_edit"]').val(json.created_at);
                          $('#formulario_sesion2 input[name="updated_at_edit"]').val(json.updated_at); 
                          console.log(json.firma_vocero);
                        } else {
                          $('#errorMessage').html(json.message);
                          $('#errorMessage').show();
                        }
                      });
          });
        });
      </script>

      <script type="text/javascript">
        function limpiarCampos (){
          $('#firma_vocero').prop('checked', false);
          $('#observacion_vocero').val('');          
        }
      </script>

      <script type="text/javascript">
        function limpiarCampos_NuevaSesion (){
          $('#semana').val('---');
          $('#nombre_tema').val('---');
          $('#tema_adicional').val('');    
          $('#hora').val('');   
          $('#firma_docente').prop('checked', false);
          $('#observacion_docente').val('');    
        }
      </script>


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

          if (page==0) {
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
    @else
    <input id="val" type="hidden" name="id_asignacion" class="input-block-level" value="" href="{{Redirect::to('/')}}" >


    @endif