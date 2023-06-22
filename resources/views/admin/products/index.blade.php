@extends('adminlte::page')

@section('title', 'Productos')

@section('content_header')
    @can('admin.products.create')
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary mb-2 float-right">Nuevo</a>
    @endcan
    <h1>Productos</h1>
@stop

@section('content')
    @livewire('admin.products-index')
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <script src="https://kit.fontawesome.com/3ace52d1a2.js" crossorigin="anonymous"></script>
@stop

@section('js')
    @livewireScripts
@stop
