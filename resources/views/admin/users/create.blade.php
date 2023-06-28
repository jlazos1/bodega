@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <h1>Nuevo Usuario</h1>
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
            {!! Form::open(['route' => 'admin.users.store', 'method' => 'post']) !!}

            {!! Form::label('name', 'Nombre', ['class' => 'h5']) !!}
            {!! Form::text('name', null, ['class' => 'form-control mb-2']) !!}
            @error('name')
                <small style="color: red">{{ $message }}</small><br>
            @enderror

            {!! Form::label('email', 'Email', ['class' => 'h5']) !!}
            {!! Form::text('email', null, ['class' => 'form-control mb-2']) !!}
            @error('email')
                <small style="color: red">{{ $message }}</small><br>
            @enderror

            {!! Form::label('password', 'Contraseña', ['class' => 'h5']) !!}
            {!! Form::password('password', ['class' => 'form-control mb-2']) !!}
            @error('password')
                <small style="color: red">{{ $message }}</small><br>
            @enderror

            {!! Form::label('branch', 'Sucursal', ['class' => 'h5']) !!}
            {!! Form::select('branch_id', $branches, null, [
                'class' => 'select-branch form-control',
                'placeholder' => 'Seleccione una Sucursal',
            ]) !!}
            @error('branch_id')
                <small style="color: red">{{ $message }}</small><br>
            @enderror


            <h2 class="h5 mt-4">Listado de roles</h2>

            @foreach ($roles as $role)
                <div>
                    <label>
                        {!! Form::checkbox('roles[]', $role->id, null, ['class' => 'mr-1']) !!}
                        {{ $role->name }}
                    </label>
                </div>
            @endforeach

            {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}

        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/styles.css">
@stop

@section('js')
    @livewireScripts

    <script>
        $(document).ready(function() {
            let select2 = $('.select-branch').select2();
            select2.data('select2').$selection.css('height', '40px');
        });
    </script>


@stop
