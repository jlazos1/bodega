@extends('adminlte::page')

@section('title', 'Proveedores')

@section('content_header')
    @can('admin.providers.create')
        <a href="{{ route('admin.providers.create') }}" class="btn btn-primary mb-2 float-right">Nuevo</a>
    @endcan

    <h1>Lista de Proveedores</h1>
@stop

@section('content')
    @livewire('admin.providers-index')
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <script src="https://kit.fontawesome.com/3ace52d1a2.js" crossorigin="anonymous"></script>
@stop

@section('js')
    @livewireScripts
@stop
