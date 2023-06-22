@extends('adminlte::page')

@section('title', 'Arriendos')

@section('content_header')
    @can('loans.checkReturn')
        <a href="{{ route('loans.checkReturn') }}" class="btn btn-primary mb-2 float-right">Comprobar Estado</a>
    @endcan
    @can('admin.loans.create')
        <a href="{{ route('admin.loans.create') }}" class="btn btn-primary mb-2 float-right mr-2">Nuevo</a>
    @endcan
    <h1>Arriendos</h1>
@stop

@section('content')
    @livewire('admin.loans-index')
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <script src="https://kit.fontawesome.com/3ace52d1a2.js" crossorigin="anonymous"></script>

@stop

@section('js')
    @livewireScripts
@stop
