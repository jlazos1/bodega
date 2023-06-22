@extends('adminlte::page')

@section('title', 'Traslados')

@section('content_header')
    @can('admin.machines-relocations.create')
        <a href="{{ route('admin.machines-relocations.create') }}" class="btn btn-primary mb-2  float-right">Nuevo</a>
    @endcan
    <h1>Traslados</h1>
@stop

@section('content')
    @livewire('admin.machines-relocation-index')
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <script src="https://kit.fontawesome.com/3ace52d1a2.js" crossorigin="anonymous"></script>
@stop

@section('js')
    @livewireScripts
@stop
