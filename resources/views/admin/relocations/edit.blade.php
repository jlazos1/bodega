@extends('adminlte::page')

@section('title', 'Traslados')

@section('content_header')
    <h1>Editar Traslado</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            {!! Form::token() !!}
            {!! Form::open(['route' => ['admin.relocations.update', $relocation], 'method' => 'put']) !!}

            {!! Form::label('origin_branch_id', 'Sucursal Origen', ['class' => 'h5']) !!}
            {!! Form::label('origin_branch_id', $origin_branch_name, ['class' => 'form-control mb-2']) !!}
            {!! Form::hidden('origin_branch_id', $relocation->origin, []) !!}
            
            @error('origin_branch_id')
                <small style="color: red">{{ $message }}</small><br>
            @enderror

            {!! Form::label('destination_branch_id', 'Sucursal Destino', ['class' => 'h5']) !!}
            {!! Form::select('destination_branch_id', $branches, $relocation->destination, [
                'class' => 'form-control mb-2 select-city',
                'placeholder' => 'Seleccione una Sucursal',
            ]) !!}
            @error('destination_branch_id')
                <small style="color: red">{{ $message }}</small><br>
            @enderror

            {!! Form::label('date', 'Fecha', ['class' => 'h5']) !!}
            {!! Form::date('date', $relocation->date, ['class' => 'form-control mb-2']) !!}
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
            $('.branch_select').select2();
        });
    </script>
@stop
