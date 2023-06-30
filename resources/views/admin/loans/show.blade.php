@extends('adminlte::page')

@section('title', 'Arriendos')

@section('content_header')
    <h1>Arriendo</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            {!! Form::label('customer_id', 'Cliente', ['class' => 'h5']) !!}
            {!! Form::label('customer_id', $customer_name, ['class' => 'form-control mb-2']) !!}

            <div class="mt-3">
                <div class="float-left mb-20" style='width: 49%'>

                    {!! Form::label('loan_date', 'Fecha Inicial', ['class' => 'h5']) !!}
                    {!! Form::label('loan_date', \Carbon\Carbon::parse($loan->loan_date)->format('d-m-Y'), [
                        'class' => 'form-control mb-2',
                    ]) !!}

                </div>
                <div class="float-right" style='width: 49%'>

                    {!! Form::label('return_date', 'Fecha Final', ['class' => 'h5']) !!}
                    {!! Form::label('return_date', \Carbon\Carbon::parse($loan->return_date)->format('d-m-Y'), [
                        'class' => 'form-control mb-2',
                    ]) !!}

                </div>
            </div>
        </div>

        <div class="card-body">
            <table class="table table-striped">
                <h2>Máquinas</h2>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($machinesAdd as $machine)
                        <tr>
                            <td>{{ $machine->machine_id }}</td>
                            <td>{{ $machine->machine_name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="card-footer">
                {{ $machinesAdd->links() }}
            </div>

            <a href="{{ route('admin.loans.index') }}" class="btn btn-primary mt-4">Volver</a>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    @livewireScripts
@stop
