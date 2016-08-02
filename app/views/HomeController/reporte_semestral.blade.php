@extends('layouts.master')


@include('includes.styles') 
@section('title')
Reporte
@stop




@section('content')



<h1 align="center">Reporte Semestral - Plan de Gestión</h1><br>

<div class="form-group ">
	<input type="hidden" name="_token" value="{{ csrf_token() }}" id="_token">
	<font size ="3", color ="#000000">{{Form::label("Seleccione un Docente: ")}}</font>
	<font size ="3", color ="#000000">{{Form::select('docentes', $docentes, null, array('id'=>'docente', 'onchange'=>'filtrarMaterias()'))}}</font>
</div>
<div class="form-group ">
	<font size ="3", color ="#000000">{{Form::label("Seleccione Materia:")}}	</font>	
	<font size ="3", color ="#000000">{{Form::select('materias', $materias, null, array('id'=>'materias'))}}	</font>	
</div>


<hr>
<!-- <center><a class="btn btn-danger btn-lg fa fa-file-pdf-o fa-2x"href="{{ URL::to('Pdf_Semestral/') }}">EXPORTAR PDF</a></center> -->
<br>
<a class="btn btn-success btn-lg fa fa-file-excel-o fa-2x"href="{{ URL::to('Repor_Excel_Semestral/') }}">EXPORTAR EXCEL</a>



<script type="text/javascript">
	function filtrarMaterias(){
		var $el = $("#materias");
		$el.empty(); // remove old options
		$.post("/qualityteam/public/materias",
		{
			id: $('#docente').val(),
			_token: $('#_token').val()
		},
		function(data, status){
	        // alert("Data: " + data + "\nStatus: " + status);
	        var asignaturas = [];
	        for (var i = 0; i < data.length; i++) {
	        	asignaturas.push(data[i].asignatura.nombre_asignaturas);
	        };

	        $.each(asignaturas, function(key,value) {
	        	$el.append($("<option></option>")
	        		.attr("value", key).text(value));
	        });

	        // console.log(asignaturas);
	    });

	}
</script>

@stop

