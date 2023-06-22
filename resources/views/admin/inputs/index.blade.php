@extends('adminlte::page')

@section('title', 'Entradas')

@section('content_header')
    @can('admin.inputs.create')
        <a href="{{ route('admin.inputs.create') }}" class="btn btn-primary mb-2 float-right">Nuevo</a>
    @endcan
    <h1>Entradas</h1>
@stop

@section('content')
    @livewire('admin.inputs-index')
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <script src="https://kit.fontawesome.com/3ace52d1a2.js" crossorigin="anonymous"></script>

@stop

@section('js')
    @livewireScripts
@stop
