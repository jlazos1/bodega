@extends('adminlte::page')

@section('title', 'Sucursales')

@section('content_header')
    <h1>Lista de Sucursales</h1>
@stop

@section('content')
    @livewire('admin.branches-index')
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    @livewireScripts
@stop
