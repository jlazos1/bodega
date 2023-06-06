@extends('adminlte::page')

@section('title', 'Salidas')

@section('content_header')
    <h1>Salidas</h1>
@stop

@section('content')
    @livewire('admin.outputs-index')
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    @livewireScripts
@stop
