@extends('adminlte::page')

@section('title', 'Clientes')

@section('content_header')
    <h1>Editar Cliente</h1>
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
            {!! Form::open(['route' => ['admin.customers.update', $customer->id], 'method' => 'put']) !!}

            {!! Form::label('name', 'Nombre', ['class' => 'h5']) !!}
            {!! Form::text('name', $customer->name, ['class' => 'form-control mb-2']) !!}

            {!! Form::label('address', 'Dirección', ['class' => 'h5']) !!}
            {!! Form::text('address', $customer->address, ['class' => 'form-control mb-2']) !!}

            {!! Form::label('phone', 'Teléfono', ['class' => 'h5']) !!}
            {!! Form::text('phone', $customer->phone, ['class' => 'form-control mb-2']) !!}

            {!! Form::label('email', 'Email', ['class' => 'h5']) !!}
            {!! Form::email('email', $customer->email, ['class' => 'form-control mb-2']) !!}

            {!! Form::label('city_id', 'Ciudad', ['class' => 'h5']) !!}
            {!! Form::select('city_id', $cities, $customer->city_id, [
                'class' => 'form-control mb-2 select-city',
                'placeholder' => 'Seleccione una ciudad',
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