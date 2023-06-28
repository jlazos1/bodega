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
            @error('name')
                <small style="color: red">{{ $message }}</small><br>
            @enderror

            {!! Form::label('value', 'Valor Monetario', ['class' => 'h5']) !!}
            {!! Form::number('value', null, ['class' => 'form-control mb-2']) !!}
            @error('value')
                <small style="color: red">{{ $message }}</small><br>
            @enderror

            {!! Form::label('asset_model_id', 'Modelo', ['class' => 'h5']) !!}
            {!! Form::select('asset_model_id', $asset_models, null, [
                'class' => 'form-control mb-2 select-model',
                'placeholder' => 'Seleccione un Modelo',
            ]) !!}
            @error('asset_model_id')
                <small style="color: red">{{ $message }}</small><br>
            @enderror

            {!! Form::label('branch_id', 'Sucursal', ['class' => 'h5']) !!}
            {!! Form::select('branch_id', $branches, null, [
                'class' => 'form-control mb-2 select-branch',
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
            let select2 = $('.select-branch').select2();
            select2.data('select2').$selection.css('height', '38px');
        });

        $(document).ready(function() {
            let select2 = $('.select-model').select2();
            select2.data('select2').$selection.css('height', '38px');
        });
    </script>

@stop
