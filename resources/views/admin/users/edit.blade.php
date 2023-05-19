@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Modificar información de usuario</h1>
@stop

@section('content')

    @if (session('info'))
        <div class="alert alert-success">
            <strong>
                {{session('info')}}
            </strong>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            {!! Form::model($user, ['route' => ['admin.users.update', $user], 'method' => 'put']) !!}

            {!! Form::label('name', 'Nombre', ['class' => 'h5']) !!}
            {!! Form::text('name', $user->name, ['class' => 'form-control mb-2']) !!}

            {!! Form::label('email', 'Email', ['class' => 'h5']) !!}
            {!! Form::text('email', $user->email, ['class' => 'form-control mb-2']) !!}

            {!! Form::label('branch', 'Sucursal', ['class' => 'h5']) !!}
            {!! Form::select('branch_id', $branches, null, [
                'class' => 'select-branch form-control',
                'placeholder' => 'Seleccione una Sucursal',
            ]) !!}


            <h2 class="h5">Listado de roles</h2>        

                @foreach ($roles as $role)
                    <div>
                        <label>
                            {!! Form::checkbox('roles[]', $role->id, null, ['class' => 'mr-1']) !!}
                            {{$role->name}}
                        </label>
                    </div>
                @endforeach

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

    <script>
        $(document).ready(function() {
            $('.select-branch').select2();
        });
    </script>
@stop
