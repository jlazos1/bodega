@extends('adminlte::page')

@section('title', 'Categorías de Productos')

@section('content_header')
    <h1>Categorías de Productos</h1>
@stop

@section('content')
    @livewire('admin.product-types-index')
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    @livewireScripts
@stop
