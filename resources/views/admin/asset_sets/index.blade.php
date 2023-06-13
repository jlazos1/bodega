@extends('adminlte::page')

@section('title', 'Conjuntos')

@section('content_header')
    <h1>Conjuntos</h1>
@stop

@section('content')
    @livewire('admin.asset-sets-index')
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <script src="https://kit.fontawesome.com/3ace52d1a2.js" crossorigin="anonymous"></script>
@stop

@section('js')
    @livewireScripts
@stop
