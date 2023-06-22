@extends('adminlte::page')

@section('title', 'Traslados')

@section('content_header')
    <h1>Traslados</h1>
@stop
@section('content')
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    @if (session('correct'))
        <div class="alert alert-success">
            {{ session('correct') }}
        </div>
    @endif
    <div class="card pr-4 pl-4 pb-5">
        {!! Form::token() !!}
        {!! Form::open(['route' => 'admin.machines-details-relocations.store', 'method' => 'post']) !!}

        {!! Form::label('machines', 'Máquinas', ['class' => 'h5 display: block mt-4 mb-4']) !!}

        {!! Form::label('machine_id', 'Nombre Máquina', ['class' => 'h5']) !!}
        {!! Form::select('machine_id', $machines, null, [
            'class' => 'form-control mb-2 select-asset',
            'multiple' => 'multiple',
            'name' => 'seleccion[]',
        ]) !!}
        @error('seleccion')
            <small style="color: red">{{ $message }}</small><br>
        @enderror

        {!! Form::hidden('relocation_id', $relocation_id, ['class' => 'form-control mb-2']) !!}

        {!! Form::submit('Agregar', ['class' => 'btn btn-primary mt-4 mb-3']) !!}

        {!! Form::close() !!}


        <div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($machinesAdd as $machine)
                        <tr>
                            <td>{{ $machine->machine_id }}</td>
                            <td>{{ $machine->machine_name }}</td>
                            <td width="10px">
                                <form action="{{ route('admin.machines-details-relocations.destroy', $machine->id) }}"
                                    method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-danger fa fa-trash"></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div>
            <a href="{{ route('admin.machines-relocations.index') }}" class="btn btn-danger float-right">Finalizar</a>
        </div>
    </div>
@stop


@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <script src="https://kit.fontawesome.com/3ace52d1a2.js" crossorigin="anonymous"></script>
@stop

@section('js')
    @livewireScripts
    <script>
        $(document).ready(function() {
            $('.select-asset').select2();
        });
    </script>
@stop
