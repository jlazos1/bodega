@extends('adminlte::page')

@section('title', 'Máquinas')

@section('content_header')
    <h1>Nueva Máquina</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            {!! Form::token() !!}
            {!! Form::open(['route' => 'admin.machines.store', 'method' => 'post']) !!}

            {!! Form::label('name', 'Nombre', ['class' => 'h5']) !!}
            {!! Form::text('name', null, ['class' => 'form-control mb-2']) !!}
            @error('name')
                <small style="color: red">{{ $message }}</small><br>
            @enderror

            {!! Form::label('value', 'Valor Monetario', ['class' => 'h5']) !!}
            {!! Form::number('value', null, ['class' => 'form-control mb-2']) !!}
            @error('value')
                <small style="color: red">{{ $message }}</small><br>
            @enderror

            {!! Form::label('games_board_id', 'Tarjeta de Juego', ['class' => 'h5']) !!}
            {!! Form::select('games_board_id', $games_boards, null, [
                'class' => 'form-control mb-2 games_boards_select',
                'placeholder' => 'Seleccione una Tarjeta de Juego',
                
            ]) !!}
            @error('games_boards_id')
                <small style="color: red">{{ $message }}</small><br>
            @enderror

            {!! Form::label('branch_id', 'Sucursal', ['class' => 'h5']) !!}
            {!! Form::select('branch_id', $branches, null, [
                'class' => 'form-control mb-2 branch-select',
                'placeholder' => 'Seleccione una Sucursal',
            ]) !!}
            @error('branch_id')
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
    <script>
        $(document).ready(function() {
            $('.games_boards_select').select2();
        });
    
        $(document).ready(function() {
            $('.branch-select').select2();
        });
    </script>

@stop
