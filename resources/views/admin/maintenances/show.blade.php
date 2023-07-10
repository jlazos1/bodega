@extends('adminlte::page')

@section('title', 'Mantenimientos')

@section('content_header')
    <h1>Editar Mantenimiento</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            {!! Form::token() !!}

            {!! Form::label('machine_id', 'Nombre Máquina', ['class' => 'h5']) !!}
            {!! Form::label('machine_name', $machine_name, ['class' => 'form-control mb-2']) !!}

            {!! Form::label('branch_name', 'Sucursal', ['class' => 'h5']) !!}
            {!! Form::label('branch_name', $branch_name, ['class' => 'form-control mb-2']) !!}

            {!! Form::label('date', 'Fecha', ['class' => 'h5']) !!}
            {!! Form::label('date', \Carbon\Carbon::parse($maintenance->date)->format('d-m-Y'), ['class' => 'form-control mb-2']) !!}

            {!! Form::label('details', 'Detalles', ['class' => 'h5']) !!}
            {!! Form::textarea('details', $maintenance->details, ['class' => 'form-control mb-2', 'readonly' => 'readonly']) !!}
            @error('details')
                <small style="color: red">{{ $message }}</small><br>
            @enderror

            <a href="{{ route('admin.maintenances.index') }}" class="btn btn-primary float-right">Volver</a>

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
