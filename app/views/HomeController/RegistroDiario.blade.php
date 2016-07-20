@if($resultado)
@extends('layouts.master2')

<link rel="shortcut icon"  type="image/png" href="http://www.uniajc.edu.co/images/favicon.ico" />


@section('title')
Registro Diario
@stop


@section('content')


@foreach($resultado as $key => $user)
@endforeach


<h1>Registro de sesión diaria</h1>
            <p>Esta sección contiene los campos que se deben diligeciar para el correcto control del registro diario</p>
            <br>          
         <div class="row">
            <div class="col-md-6">
               <div class="form-group">
                  <label for="facultad">Facultad</label>
                  <input id="facultad" type="text" class="form-control input-md" placeholder="{{ $user->nombre_facultades}}"disabled>
               </div>
            </div>
            <div class="col-md-6">
              <label for="docente">Docente</label>
              <input id="docente" type="text" class="form-control input-md" placeholder="{{ $user->nombre_user}}"disabled>
            </div>
         </div>
         <div class="row">
            <div class="col-md-6">
               <label for="materia">Materia</label>
               <input id="materia" type="text" class="form-control input-md" placeholder="{{ $user->nombre_asignaturas}}"disabled>
            </div>
            <div class="col-md-6">
               <div class="row">
                  <div class="col-md-4">
                     <label for="periodo">Periodo</label>
                     <input id="periodo" "=" type="text " class="form-control input-md " placeholder="{{ $user->periodo}}"disabled>
                  </div>
                  <div class="col-md-4 ">
                     <label for="grupo">Grupo</label>
                     <input id="grupo " type="text " class="form-control input-md " placeholder="{{ $user->nombre_facultades}}"disabled>
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
         @foreach($resultado as $key => $user)
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
            @endforeach
         </div>
         <br>
         <br>
         <a class="btn btn-small btn-primary fa fa-floppy-o " id="save "> Guardar</a>      
</section>


@stop
@else
@section('content')
@section('title')
Registro Diario
@stop

<img src="../images/error.png" alt="..." WIDTH=178 HEIGHT=180>
<h1>No se encontró ninguna asignación.</h1>
@stop
@endif