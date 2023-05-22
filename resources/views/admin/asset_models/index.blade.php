@extends('adminlte::page')

@section('title', 'Modelos de Activos')

@section('content_header')
    <h1>Modelos de Activos</h1>
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
