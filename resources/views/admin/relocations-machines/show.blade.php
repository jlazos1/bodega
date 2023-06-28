@extends('adminlte::page')

@section('title', 'Traslados')

@section('content_header')
    <h1>Traslado</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            {!! Form::token() !!}

            {!! Form::label('origin_branch_id', 'Sucursal Origen', ['class' => 'h5']) !!}
            {!! Form::label('origin_branch_id', $origin_name, ['class' => 'form-control mb-2']) !!}
            {!! Form::hidden('origin_branch_id', $relocation->origin, []) !!}

            {!! Form::label('destination_branch_id', 'Sucursal Destino', ['class' => 'h5']) !!}
            {!! Form::label('destination_branch_id', $destination_name, ['class' => 'form-control mb-2']) !!}

            {!! Form::label('date', 'Fecha', ['class' => 'h5']) !!}
            {!! Form::label('date', \Carbon\Carbon::parse($relocation->date)->format('d-m-Y'), [
                'class' => 'form-control mb-2',
            ]) !!}



            <div>
                <table class="table table-striped mt-5">
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
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $machinesAdd->links() }}
            </div>

            <a href="{{ route('admin.machines-relocations.index') }}" class="btn btn-primary mt-3">Volver</a>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    @livewireScripts

@stop
