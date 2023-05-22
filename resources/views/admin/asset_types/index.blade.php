@extends('adminlte::page')

@section('title', 'Tipos de Activos')

@section('content_header')
    <h1>Tipos de Activos</h1>
@stop

@section('content')
    @livewire('admin.asset-types-index')
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    @livewireScripts
@stop
