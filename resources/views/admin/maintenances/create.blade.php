@extends('adminlte::page')

@section('title', 'Mantenimientos')

@section('content_header')
    <h1>Nuevo Mantenimiento</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            {!! Form::token() !!}
            {!! Form::open(['route' => 'admin.maintenances.store', 'method' => 'post']) !!}

            {!! Form::label('machine_id', 'Nombre Máquina', ['class' => 'h5']) !!}
            {!! Form::select('machine_id', $machines, null, [
                'class' => 'form-control mb-2 select-machine',
                'placeholder'   => 'Seleccione una máquina'
            ]) !!}
            @error('machine_id')
                <small style="color: red">{{ $message }}</small><br>
            @enderror

            {!! Form::label('date', 'Fecha', ['class' => 'h5']) !!}
            {!! Form::date('date', null, ['class' => 'form-control mb-2']) !!}
            @error('date')
                <small style="color: red">{{ $message }}</small><br>
            @enderror

            {!! Form::label('details', 'Detalles', ['class' => 'h5']) !!}
            {!! Form::textarea('details', null, ['class' => 'form-control mb-2']) !!}
            @error('details')
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
            let select2 = $('.select-machine').select2();
            select2.data('select2').$selection.css('height', '38px');
        });
    </script>

@stop
