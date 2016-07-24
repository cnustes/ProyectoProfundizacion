@extends('layouts.master')


 @include('includes.styles') 
@section('title')
 Reporte
@stop




@section('content')

<h1 align="center">Reporte Semestral - Plan de Gestión</h1><br>
<hr>
 <center><a class="btn btn-danger btn-lg fa fa-file-pdf-o fa-2x"href="{{ URL::to('Pdf_Semestral/') }}">EXPORTAR PDF</a></center>
<br>
 <center><a class="btn btn-success btn-lg fa fa-file-excel-o fa-2x"href="{{ URL::to('Repor_Excel_Semestral/') }}">EXPORTAR EXCEL</a></center>

@stop

