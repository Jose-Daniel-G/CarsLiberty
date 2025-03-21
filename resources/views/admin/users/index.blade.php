@extends('adminlte::page')

@section('title', 'JDeveloper')

@section('content_header')
    <h1>Lista de usuarios</h1>
@stop
@section('content')
<p>hey</p>
    @livewire('admin.users-index')
@stop
@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
@section('js')
   <script>console.log('hi!')</script>
@stop
