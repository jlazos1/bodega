@extends('adminlte::page')

@section('title', 'Activos')

@section('content_header')
    <h1>Nuevo Activo</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            {!! Form::token() !!}
            {!! Form::open(['route' => 'admin.assets.store', 'method' => 'post']) !!}

            {!! Form::label('name', 'Nombre', ['class' => 'h5']) !!}
            {!! Form::text('name', null, ['class' => 'form-control mb-2']) !!}

            {!! Form::label('value', 'Valor Monetario', ['class' => 'h5']) !!}
            {!! Form::number('value', null, ['class' => 'form-control mb-2']) !!}

            {!! Form::label('asset_model_id', 'Modelo', ['class' => 'h5']) !!}
            {!! Form::select('asset_model_id', $asset_models, null, [
                'class' => 'form-control mb-2',
                'placeholder' => 'Seleccione un Modelo',
            ]) !!}

            {!! Form::label('branch_id', 'Sucursal', ['class' => 'h5']) !!}
            {!! Form::select('branch_id', $branches, null, [
                'class' => 'form-control mb-2',
                'placeholder' => 'Seleccione una Sucursal',
            ]) !!}

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
