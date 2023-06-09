@extends('adminlte::page')

@section('title', 'Tipo de Activo')

@section('content_header')
    <h1>Editar Tipo de Activo</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            {!! Form::token() !!}
            {!! Form::open(['route' => ['admin.asset_models.update', $asset_model], 'method' => 'put']) !!}

            {!! Form::label('name', 'Nombre', ['class' => 'h5']) !!}
            {!! Form::text('name', $asset_model->name, ['class' => 'form-control mb-2']) !!}
            @error('name')
                <small style="color: red">{{ $message }}</small><br>
            @enderror

            {!! Form::label('description', 'Descripción', ['class' => 'h5']) !!}
            {!! Form::textarea('description', $asset_model->description, ['class' => 'form-control mb-2']) !!}
            @error('description')
                <small style="color: red">{{ $message }}</small><br>
            @enderror

            {!! Form::label('asset_type_id', 'Tipo de Activo', ['class' => 'h5']) !!}
            {!! Form::select('asset_type_id', $asset_types, $asset_model->asset_type_id, [
                'class' => 'form-control mb-2',
                'placeholder' => 'Seleccione un tipo de activo',
            ]) !!}
            @error('asset_type_id')
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
