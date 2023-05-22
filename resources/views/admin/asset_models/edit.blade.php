@extends('adminlte::page')

@section('title', 'Tipo de Activo')

@section('content_header')
    <h1>Editar Tipo de Activo</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            {!! Form::token() !!}
            {!! Form::open(['route' => ['admin.asset_models.update', $asset_type], 'method' => 'put']) !!}

            {!! Form::label('name', 'Nombre', ['class' => 'h5']) !!}
            {!! Form::text('name', $asset_model->name, ['class' => 'form-control mb-2']) !!}

            {!! Form::label('description', 'Descripción', ['class' => 'h5']) !!}
            {!! Form::textarea('description', $asset_model->description, ['class' => 'form-control mb-2']) !!}

            {!! Form::label('asset_type_id', 'Tipo de Activo', ['class' => 'h5']) !!}
            {!! Form::select('asset_type_id', $asset_types, $asset_model->asset_type_id, [
                'class' => 'form-control mb-2',
                'placeholder' => 'Seleccione un tipo de activo',
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