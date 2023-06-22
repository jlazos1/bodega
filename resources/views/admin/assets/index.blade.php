@extends('adminlte::page')

@section('title', 'Activos')

@section('content_header')
    @can('admin.assets.create')
        <a href="{{ route('admin.assets.create') }}" class="btn btn-primary mb-2 float-right">Nuevo</a>
    @endcan

    <h1>Activos</h1>
@stop

@section('content')
    @livewire('admin.assets-index')
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <script src="https://kit.fontawesome.com/3ace52d1a2.js" crossorigin="anonymous"></script>
@stop

@section('js')
    @livewireScripts
@stop
