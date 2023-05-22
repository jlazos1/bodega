@extends('adminlte::page')

@section('title', 'Proveedores')

@section('content_header')
    <h1>Lista de Proveedores</h1>
@stop

@section('content')
    @livewire('admin.providers-index')
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    @livewireScripts
@stop
