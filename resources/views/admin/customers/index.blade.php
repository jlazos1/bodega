@extends('adminlte::page')

@section('title', 'Clientes')

@section('content_header')
    @can('admin.customers.create')
        <a href="{{ route('admin.customers.create') }}" class="btn btn-primary mb-2 float-right">Nuevo</a>
    @endcan
    <h1>Lista de Clientes</h1>
@stop

@section('content')
    @livewire('admin.customers-index')
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <script src="https://kit.fontawesome.com/3ace52d1a2.js" crossorigin="anonymous"></script>
@stop

@section('js')
    @livewireScripts
@stop
