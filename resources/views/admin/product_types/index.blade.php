@extends('adminlte::page')

@section('title', 'Categorías de Productos')

@section('content_header')
    @can('admin.product_types.create')
        <a href="{{ route('admin.product_types.create') }}" class="btn btn-primary mb-2 float-right">Nuevo</a>
    @endcan
    <h1>Categorías de Productos</h1>
@stop

@section('content')
    @livewire('admin.product-types-index')
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <script src="https://kit.fontawesome.com/3ace52d1a2.js" crossorigin="anonymous"></script>

@stop

@section('js')
    @livewireScripts
@stop
