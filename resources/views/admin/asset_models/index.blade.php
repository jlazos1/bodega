@extends('adminlte::page')

@section('title', 'Modelos de Activos')

@section('content_header')
    @can('admin.asset_models.create')
        <a href="{{ route('admin.asset_models.create') }}" class="btn btn-primary mb-2 float-right">Nuevo</a>
    @endcan
    <h1>Modelos de Activos</h1>
@stop

@section('content')
    @livewire('admin.asset-models-index')
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <script src="https://kit.fontawesome.com/3ace52d1a2.js" crossorigin="anonymous"></script>
@stop

@section('js')
    @livewireScripts
@stop
