@extends('layouts.master')




@section('title')
  Inicio
@stop
 @include('includes.styles')

<script>
  $(document).ready(function() {
    $('#example').DataTable();
} );
  </script>

@section('content')
<body>

<div class="container">
<div class="col-lg-12">
<div class="panel panel-primary">
<div class="panel-heading">
<h1><center><b><font size ="3", color="#fbfbfb" face="Arial Black">AQUÍ VERAS TODOS LAS ASIGNATURAS Y GRUPOS DONDE ERES DOCENTE.</center></font></b></h1>
</div>
<div class="table-responsive">
<table class="table" id="example">
<thead>
<tr>
<th>Nombre Asignatura</th>
<th>Periodo</th>
<th>Nombre Grupo</th>
<th>Opciones</th>
</tr>
</thead>
<tbody>
<tr>        
@if($resultado)
<!--asignamos a un bucle de array $users a $user-->
@foreach($resultado as $key => $user)
<td><b><font size ="3", color ="#016cdf">{{ $user->nombre_asignaturas}}</font></b></td>
<td><b><font size ="3", color ="#016cdf">{{ $user->periodo}}</font></b></td>
<td><b><font size ="3", color ="#016cdf">{{ $user->nombre_grupo}}</font></b></td>

<td>

<a title="Reporte Diario" class="btn btn-info glyphicon glyphicon-repeat" href="{{ URL::to('reporteDiario/' . $user->programa_id ) }}"></a>


</td>

      </tr>
      @endforeach
    </tbody>
  </table>

  </div>
    
</div>

</td>
</tr>


@endif
@stop

