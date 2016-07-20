@extends('layouts.master')


    
@section('title')
 Reporte
@stop




@section('content')

<h1 align="center">Reporte Semestral - Plan de Gestión</h1><br>
<hr>
 <center><a class="btn btn-danger btn-lg"href="{{ URL::to('Pdf_Semestral/') }}">EXPORTAR PDF</a></center>

@stop

