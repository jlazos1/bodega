@extends('adminlte::page')

@section('title', 'Stock por Sucursal')

@section('content_header')
    <h1>Stock por Sucursal</h1>
@stop

@section('content')
    @livewire('admin.stock-branch-index')
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <script src="https://kit.fontawesome.com/3ace52d1a2.js" crossorigin="anonymous"></script>
@stop

@section('js')
    @livewireScripts
@stop
