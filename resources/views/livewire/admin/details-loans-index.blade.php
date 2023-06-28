@extends('adminlte::page')

@section('title', 'Arriendos')

@section('content_header')
    <h1>Arriendos</h1>
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
    <div class="card pr-4 pl-4 pb-5 pt-3">
        {!! Form::token() !!}
        {!! Form::open(['route' => 'admin.detalles-loans.store', 'method' => 'post']) !!}

        {!! Form::label('machine_id', 'Máquina', ['class' => 'h5']) !!}
        {!! Form::select('machine_id', $machines, null, [
            'class' => 'form-control mb-2 select-machine',
            'multiple' => 'multiple',
            'name' => 'seleccion[]',
        ]) !!}

        {!! Form::hidden('loan_id', $loan_id, ['class' => 'form-control mb-2']) !!}

        {!! Form::submit('Agregar', ['class' => 'btn btn-primary mt-4 mb-3']) !!}

        {!! Form::close() !!}


        <div>
            {!! Form::label('machines', 'Máquinas', ['class' => 'h5 display: block mt-4 mb-4']) !!}

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
                                <form action="{{ route('admin.detalles-loans.destroy', $machine->id) }}" method="POST">
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
            <a href="{{ route('admin.loans.index') }}" class="btn btn-danger float-right">Finalizar</a>
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
            let select2 = $('.select-machine').select2();
            select2.data('select2').$selection.css('height', '38px');
        });
    </script>
@stop
