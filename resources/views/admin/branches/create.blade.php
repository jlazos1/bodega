@extends('adminlte::page')

@section('title', 'Nueva Sucursal')

@section('content_header')
    <h1>Nueva Sucursal</h1>
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
            {!! Form::open(['route' => 'admin.branches.store', 'method' => 'post']) !!}
            <p class="h5">Nombre</p>
            {!! Form::text('name', null, ['class' => 'form-control mb-2']) !!}

            <p class="h5">Dirección</p>
            {!! Form::text('address', null, ['class' => 'form-control mb-2']) !!}

            <p class="h5">Teléfono</p>
            {!! Form::text('phone', null, ['class' => 'form-control mb-2']) !!}

            <p class="h5">Ciudad</p>

            {!! Form::select('city_id', $cities, null, [
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
    <script>
        $(document).ready(function() {
            $('.select-city').select2();
        });
    </script>

@stop
