@extends('adminlte::page')

@section('title', 'Entradas')

@section('content_header')
    <h1>Entradas</h1>
@stop

@section('content')
    @livewire('admin.inputs-index')
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    @livewireScripts
@stop
