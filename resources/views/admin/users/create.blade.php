@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Nuevo Usuario</h1>
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
            {!! Form::token() !!}
            {!! Form::open(['route' => 'admin.users.store', 'method' => 'post']) !!}
            <p class="h5">Nombre</p>
            {!! Form::text('name', null, ['class' => 'form-control mb-2']) !!}

            <p class="h5">Email</p>
            {!! Form::text('email', null, ['class' => 'form-control mb-2']) !!}

            <p class="h5">Contraseña</p>
            {!! Form::password('password', ['class' => 'form-control mb-2']) !!}


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
@stop
