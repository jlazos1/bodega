@extends('adminlte::page')

@section('title', 'Salidas')

@section('content_header')
    <h1>Nueva Salida</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            {!! Form::token() !!}
            {!! Form::open(['route' => 'admin.outputs.store', 'method' => 'post']) !!}

            {!! Form::label('origin_branch_id', 'Sucursal Origen', ['class' => 'h5']) !!}
            {!! Form::select('origin_branch_id', $branches, null, [
                'class' => 'form-control mb-2 select-city',
                'placeholder' => 'Seleccione una Sucursal',
            ]) !!}
            @error('origin_branch_id')
                <small style="color: red">{{ $message }}</small><br>
            @enderror

            {!! Form::label('destination_branch_id', 'Sucursal Destino', ['class' => 'h5']) !!}
            {!! Form::select('destination_branch_id', $branches, null, [
                'class' => 'form-control mb-2 select-city',
                'placeholder' => 'Seleccione una Sucursal',
            ]) !!}
            @error('destination_branch_id')
                <small style="color: red">{{ $message }}</small><br>
            @enderror

            {!! Form::label('date', 'Fecha', ['class' => 'h5']) !!}
            {!! Form::date('date', null, ['class' => 'form-control mb-2']) !!}
            @error('date')
                <small style="color: red">{{ $message }}</small><br>
            @enderror

            {!! Form::submit('Siguiente', ['class' => 'btn btn-primary mt-4']) !!}

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
