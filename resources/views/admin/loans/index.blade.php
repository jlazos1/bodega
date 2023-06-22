@extends('adminlte::page')

@section('title', 'Arriendos')

@section('content_header')
    <h1>Arriendos</h1>
@stop

@section('content')
    @livewire('admin.loans-index')
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <script src="https://kit.fontawesome.com/3ace52d1a2.js" crossorigin="anonymous"></script>

@stop

@section('js')
    @livewireScripts
@stop
