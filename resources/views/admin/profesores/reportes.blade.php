@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Sistema de reservas </h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <h1>Reportes de profesores</h1>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Generar reporte</h3>
                </div>
                <div class="card-body">
                        </div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <a href="{{ route('admin.profesores.pdf') }}" class="btn btn-success"><i
                                            class="fas fa-print">Listado de personal Medico</i></a><br><br>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop

@section('css')

@stop

@section('js')

@stop
