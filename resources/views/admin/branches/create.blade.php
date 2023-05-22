@extends('adminlte::page')

@section('title', 'Nueva Sucursal')

@section('content_header')
    <h1>Nueva Sucursal</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            {!! Form::token() !!}
            {!! Form::open(['route' => 'admin.branches.store', 'method' => 'post']) !!}

            {!! Form::label('name', 'Nombre', ['class' => 'h5']) !!}
            {!! Form::text('name', null, ['class' => 'form-control mb-2']) !!}

            {!! Form::label('address', 'Dirección', ['class' => 'h5']) !!}
            {!! Form::text('address', null, ['class' => 'form-control mb-2']) !!}

            {!! Form::label('phone', 'Teléfono', ['class' => 'h5']) !!}
            {!! Form::text('phone', null, ['class' => 'form-control mb-2']) !!}

            {!! Form::label('city_id', 'Ciudad', ['class' => 'h5']) !!}
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
