@extends('adminlte::page')

@section('title', 'Sucursal')

@section('content_header')
    <h1>Editar Sucursal</h1>
@stop

@section('content')

    @if (session('info'))
        <div class="alert alert-success">
            <strong>
                {{ session('info') }}
            </strong>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            {!! Form::token() !!}
            {!! Form::open(['route' => ['admin.branches.update', $branch], 'method' => 'put']) !!}

            {!! Form::label('name', 'Nombre', ['class' => 'h5']) !!}
            {!! Form::text('name', $branch->name, ['class' => 'form-control mb-2']) !!}

            {!! Form::label('address', 'Dirección', ['class' => 'h5']) !!}
            {!! Form::text('address', $branch->address, ['class' => 'form-control mb-2']) !!}

            {!! Form::label('phone', 'Teléfono', ['class' => 'h5']) !!}
            {!! Form::text('phone', $branch->phone, ['class' => 'form-control mb-2']) !!}

            {!! Form::label('city_id', 'Ciudad', ['class' => 'h5']) !!}
            {!! Form::select('city_id', $cities, $branch->city_id, ['class' => 'form-control mb-2', 'placeholder' => 'Seleccione una ciudad']) !!}

            {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}

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
