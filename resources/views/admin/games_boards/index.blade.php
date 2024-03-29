@extends('adminlte::page')

@section('title', 'Tarjetas de Juegos')

@section('content_header')
    @can('admin.game-boards.create')
        <a href="{{ route('admin.game-boards.create') }}" class="btn btn-primary mb-2 float-right">Nuevo</a>
    @endcan
    <h1>Tarjetas de Juegos</h1>
@stop

@section('content')
    @livewire('admin.games-boards-index')
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <script src="https://kit.fontawesome.com/3ace52d1a2.js" crossorigin="anonymous"></script>
@stop

@section('js')
    @livewireScripts
@stop
