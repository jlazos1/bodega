@extends('adminlte::page')

@section('title', 'Traslados')

@section('content_header')
    <h1>Nuevo Traslado</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            {!! Form::token() !!}
            {!! Form::open(['route' => 'admin.relocations.store', 'method' => 'post']) !!}

            {!! Form::label('origin_branch_id', 'Sucursal Origen', ['class' => 'h5 mt-2']) !!}
            {!! Form::select('origin_branch_id', $branches, null, [
                'class' => 'form-control mb-2 select-branch',
                'placeholder' => 'Seleccione una Sucursal',
                'id'    => 'select-prueba'
            ]) !!}
            @error('origin_branch_id')
                <small style="color: red">{{ $message }}</small><br>
            @enderror

            {!! Form::label('destination_branch_id', 'Sucursal Destino', ['class' => 'h5 mt-2']) !!}
            {!! Form::select('destination_branch_id', $branches, null, [
                'class' => 'form-control mb-2 select-branch2',
                'placeholder' => 'Seleccione una Sucursal',
            ]) !!}
            @error('destination_branch_id')
                <small style="color: red">{{ $message }}</small><br>
            @enderror

            {!! Form::label('date', 'Fecha', ['class' => 'h5 mt-2']) !!}
            {!! Form::date('date', null, ['class' => 'form-control mb-2', 'id'    => 'select-prueba']) !!}
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
    <script>
        $(document).ready(function() {
            let select2 = $('.select-branch').select2();
            select2.data('select2').$selection.css('height', '38px');
        });
        $(document).ready(function() {
            let select2 = $('.select-branch2').select2();
            select2.data('select2').$selection.css('height', '38px');
        });
    </script>
@stop
