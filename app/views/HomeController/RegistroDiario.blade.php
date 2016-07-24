@if($resultado)
@extends('layouts.master2')
<link rel="shortcut icon"  type="image/png" href="http://www.uniajc.edu.co/images/favicon.ico" />
@section('title')
Registro Diario
@stop
@section('content')
@foreach($resultado as $key => $user)
@endforeach



<div class="panel panel-info">
  <div class="panel-heading"><h1>Registro de sesión diaria</h1></div>
  <div class="bg-danger">{{$errors->first('semana')}}</div>
  <div class="bg-danger">{{$errors->first('tema')}}</div>
  <div class="bg-danger">{{$errors->first('observacion_vocero')}}</div>
  <div class="bg-danger">{{$errors->first('observacion_docente')}}</div>

  <div class="panel-body">
    {{Session::get("message")}}
    
    <button type="button" id="mostrar" class="btn-primary " data-dismiss="modal" title="Nueva Sesión">Nueva Sesion</button>
    <br>
    <button type="button" id="ver" class="btn-info " data-dismiss="modal" title="Ver Sesiones">Ver Sesiones</button>
    <div class="login-container" id="panelsito" style="display:none" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="panel panel-primary">
        <div class="panel-heading">

          <h3 class="panel-title">Registrar - Nueva Sesión</h3>

        </div>        
        <div class="panel-body">

          {{Form::open(array(
          "method" => "POST",
          "action" => "registroDiario",
          "role" => "form",
          ))}}
          
          
          <div class="row">
            <div class="form-group ">
              {{Form::input("hidden", "asignacion_id", $user->id)}}             
            </div>
          </div>

          <div class="row">
            <div class="form-group ">
              {{Form::label("FACULTAD:")}}
              {{Form::label($user->facultad->nombre_facultades)}}
              <div class="bg-danger">{{$errors->first('titulo')}}</div>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-sm-6">
              {{Form::label("DOCENTE:")}}
              {{Form::label($user->persona->nombre_user)}}
              <div class="bg-danger">{{$errors->first('titulo')}}</div>
            </div>
            <div class="form-group col-sm-6">
              {{Form::label("MATERIA:")}}
              {{Form::label($user->asignatura->nombre_asignaturas)}}
              <div class="bg-danger">{{$errors->first('titulo')}}</div>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-sm-6">
              {{Form::label("PERIODO:")}}
              {{Form::label("$user->periodo")}}
              <div class="bg-danger">{{$errors->first('titulo')}}</div>
            </div>
            <div class="form-group col-sm-6">
              {{Form::label("GRUPO:")}}
              {{Form::label($user->grupo->nombre_grupo)}}
              <div class="bg-danger">{{$errors->first('titulo')}}</div>
            </div>
          </div>       
          <div class="form-group">
            {{ Form::label('tema_id', 'TEMA') }} 
            @foreach($resultado as $key => $user)
            {{ Form::select('tema_id', array('0' => 'Seleccione un tema', $user->tema->id => $user->tema->nombre_tema), Input::old('tema_id'), array('class' => 'form-control')) }}
            @endforeach
          </div>
            <div class="form-group">
              {{Form::label("TEMA ADICIONAL:")}}
              {{Form::input("tema_adicional", "tema_adicional", null, array("class" => "form-control"))}}          
            <div class="bg-danger">{{$errors->first('titulo')}}</div>
            </div>

          <div class="form-group">
            {{Form::label("SEMANA:")}}
            {{Form::input("semana", "semana", null, array("class" => "form-control"))}}          
            <div class="bg-danger">{{$errors->first('titulo')}}</div>
          </div>
          <div class="form-group">
            {{Form::label("Firma Docente:")}}
            {{Form::input("checkbox", "remember", "On")}}
          </div>
          
          <div class="form-group">
            {{Form::label("Observaciones:")}}            
            {{Form::textarea("observacion_vocero", null, array("class" => "form-control"))}}
            <div class="bg-danger">{{$errors->first('descripcion')}}</div>
          </div>
          <div class="form-group">
            {{Form::input("hidden", "_token", csrf_token())}}
            {{Form::input("submit", null, "Registrar", array("class" => "btn btn-primary"))}}
            <button type="button" class="btn btn-primary" id="ocu" data-dismiss="modal">Cancelar</button>
          </div>
          

          

          {{Form::close()}}
        </div>
        <div class="panel-footer">Registrando Reporte Diario</div>
      </div>
    </div>
    <script>
      $(document).ready(function() {
        $("#mostrar").click(function(){
          $("#panelsito").show("slow");
        });
        $("#ocu").click(function(){
          $("#panelsito").hide("slow");
        });
        $("#mostrar").click(function(){
          $("#mostrar").hide("slow");
        });
        $("#ocu").click(function(){
          $("#mostrar").show("slow");
        });
        $("#mostrar2").click(function(){
          $("#panelsito").show("slow");
          $("#mostrar").hide("slow");
        });
      });
    </script>
    <script>
      $(document).ready(function() {
        $("#ver").click(function(){
          $("#panelsito2").show("slow");
        });
        $("#ocu2").click(function(){
          $("#panelsito2").hide("slow");
        });
        $("#ver").click(function(){
          $("#ver").hide("slow");
        });
        $("#ocu2").click(function(){
          $("#ver").show("slow");
        });
        $("#ver").click(function(){
          $("#panelsito2").show("slow");
          $("#ver").hide("slow");
        });
      });
    </script>
    <div class="login-container2" id="panelsito2" style="display:none" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title">Listado - SESIONES</h3>
        </div>
        <div class="panel-body">

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="facultad">Facultad</label>
                <input id="facultad" type="text" class="form-control input-md" placeholder="{{ $user->facultad->nombre_facultades}}"disabled>
              </div>
            </div>
            <div class="col-md-6">
              <label for="docente">Docente</label>
              <input id="docente" type="text" class="form-control input-md" placeholder="{{ $user->persona->nombre_user}}"disabled>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <label for="materia">Materia</label>
              <input id="materia" type="text" class="form-control input-md" placeholder="{{ $user->asignatura->nombre_asignaturas}}"disabled>
            </div>
            <div class="col-md-6">
              <div class="row">
                <div class="col-md-4">
                  <label for="periodo">Periodo</label>
                  <input id="periodo" "=" type="text " class="form-control input-md " placeholder="{{ $user->periodo}}"disabled>
                </div>
                <div class="col-md-4 ">
                  <label for="grupo">Grupo</label>
                  <input id="grupo " type="text " class="form-control input-md " placeholder="{{ $user->grupo->nombre_grupo}}"disabled>
                </div>
                <div class="col-md-4">
                  <label for="dia">Día</label>
                  <input id="dia" type="text " class="form-control input-md " placeholder="Lunes"disabled>
                </div>
              </div>
            </div>
          </div>
          <br>
          <br>
          
          <div class="row">
            <div class="table-responsive ">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>MES</th>
                    <th>DIA</th>
                    <th>HORAS</th>
                    <th>SEMANA</th>
                    <th>TEMA</th>
                    <th>FIRMA DOCENTE</th>
                    <th>FIRMA VOCERO</th>
                    <th>OBSERVACIONES</th>
                  </tr>
                </thead>
                <td>01</td>
                <td>01</td>
                <td><input id="dia" type="text" class="form-control input-sm" placeholder="1h"></td>
                <td>1</td>
                <td>
                  <select class="form-control">
                    @foreach($resultado as $key => $user)
                    <option>{{ $user->nombre_tema}}</option>
                    @endforeach
                  </select>
                  <br>
                  <input type="text" class="form-control input-md" placeholder="Tema adicional">
                </td>
                <td>
                  <input type="checkbox" class="form-control checkbox">
                </td>
                <td>
                  <input type="checkbox" class="form-control checkbox">
                </td>
                <td>
                  <textarea></textarea>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        
      </div>
      <br>
      <br>
      <button type="button" class="btn btn-primary" id="ocu2" data-dismiss="modal">Cancelar</button>
    </section>
  </div>
</div>
</div>
</div>
</div>
</div>
@stop
@endif