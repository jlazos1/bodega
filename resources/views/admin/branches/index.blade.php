@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <h1>Lista de usuarios</h1>
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
