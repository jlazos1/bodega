@extends('adminlte::page')

@section('title', 'Clientes')

@section('content_header')
    <h1>Nuevo Cliente</h1>
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
            {!! Form::open(['route' => 'admin.customers.store', 'method' => 'post']) !!}

            {!! Form::label('name', 'Nombre', ['class' => 'h5']) !!}
            {!! Form::text('name', null, ['class' => 'form-control mb-2']) !!}
            @error('name')
                <small style="color: red">{{ $message }}</small><br>
            @enderror

            {!! Form::label('address', 'Dirección', ['class' => 'h5']) !!}
            {!! Form::text('address', null, ['class' => 'form-control mb-2']) !!}
            @error('address')
                <small style="color: red">{{ $message }}</small><br>
            @enderror

            {!! Form::label('phone', 'Teléfono', ['class' => 'h5']) !!}
            {!! Form::text('phone', null, ['class' => 'form-control mb-2']) !!}
            @error('phone')
                <small style="color: red">{{ $message }}</small><br>
            @enderror

            {!! Form::label('email', 'Email', ['class' => 'h5']) !!}
            {!! Form::email('email', null, ['class' => 'form-control mb-2']) !!}
            @error('email')
                <small style="color: red">{{ $message }}</small><br>
            @enderror

            {!! Form::label('city_id', 'Ciudad', ['class' => 'h5']) !!}
            {!! Form::select('city_id', $cities, null, [
                'class' => 'form-control mb-2 select-city',
                'placeholder' => 'Seleccione una ciudad',
            ]) !!}
            @error('city_id')
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
            let select2 = $('.select-city').select2();
            select2.data('select2').$selection.css('height', '38px');
        });
    </script>

@stop
