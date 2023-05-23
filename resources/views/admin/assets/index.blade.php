@extends('adminlte::page')

@section('title', 'Activos')

@section('content_header')
    <h1>Activos</h1>
@stop

@section('content')
    @livewire('admin.assets-index')
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    @livewireScripts
@stop
