@extends('adminlte::page')

@section('title', 'Conjuntos')

@section('content_header')
    <h1>Editar Conjunto</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            {!! Form::token() !!}
            {!! Form::open(['route' => ['admin.asset_sets.update', $set], 'method' => 'put']) !!}

            {!! Form::label('slot_id', 'Máquina', ['class' => 'h5']) !!}
            {!! Form::select('slot_id', $slots, $set->slot_id, [
                'class' => 'form-control mb-2',
                'placeholder' => 'Seleccione una máquina',
            ]) !!}
            @error('slot_id')
                <small style="color: red">{{ $message }}</small><br>
            @enderror

            {!! Form::label('screen_id', 'Pantalla', ['class' => 'h5']) !!}
            {!! Form::select('screen_id', $screens, $set->screen_id, [
                'class' => 'form-control mb-2',
                'placeholder' => 'Seleccione una pantalla',
            ]) !!}
            @error('screen_id')
                <small style="color: red">{{ $message }}</small><br>
            @enderror

            {!! Form::label('pc_id', 'Computador', ['class' => 'h5']) !!}
            {!! Form::select('pc_id', $pcs, $set->pc_id, [
                'class' => 'form-control mb-2',
                'placeholder' => 'Seleccione un computador',
            ]) !!}
            @error('pc_id')
                <small style="color: red">{{ $message }}</small><br>
            @enderror

            {!! Form::label('card_id', 'IO Board', ['class' => 'h5']) !!}
            {!! Form::select('card_id', $boards, $set->card_id, [
                'class' => 'form-control mb-2',
                'placeholder' => 'Seleccione una IO Board',
            ]) !!}
            @error('card_id')
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
            $('.select-slot').select2();
        });
        $(document).ready(function() {
            $('.select-board').select2();
        });
        $(document).ready(function() {
            $('.select-screen').select2();
        });
        $(document).ready(function() {
            $('.select-pc').select2();
        });
    </script>
@stop
