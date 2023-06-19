@extends('adminlte::page')

@section('title', 'Tarjeta de Juego')

@section('content_header')
    <h1>Nueva Tarjeta de Juego</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            {!! Form::token() !!}
            {!! Form::open(['route' => 'admin.game-boards.store', 'method' => 'post']) !!}

            {!! Form::label('name', 'Nombre', ['class' => 'h5']) !!}
            {!! Form::text('name', null, ['class' => 'form-control mb-2']) !!}
            @error('name')
                <small style="color: red">{{ $message }}</small><br>
            @enderror

            {!! Form::label('description', 'Descripción', ['class' => 'h5']) !!}
            {!! Form::textarea('description', null, ['class' => 'form-control mb-2']) !!}
            @error('description')
                <small style="color: red">{{ $message }}</small><br>
            @enderror
         
            {!! Form::submit('Guardar', ['class' => 'btn btn-primary mt-4']) !!}

            {!! Form::close() !!}

        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    @livewireScripts

@stop
