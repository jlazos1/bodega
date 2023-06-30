@extends('adminlte::page')

@section('title', 'Movimiento Interno')

@section('content_header')
    <h1>Movimiento Interno</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            {!! Form::token() !!}
            {!! Form::open(['route' => ['admin.outputs.update', $output], 'method' => 'put']) !!}

            {!! Form::label('origin_branch_id', 'Sucursal Origen', ['class' => 'h5']) !!}
            {!! Form::label('origin_branch_id', $origin_branch_name, ['class' => 'form-control mb-2']) !!}

            {!! Form::label('destination_branch_id', 'Sucursal Destino', ['class' => 'h5']) !!}
            {!! Form::label('origin_branch_id', $destination_branch_name, ['class' => 'form-control mb-2']) !!}

            {!! Form::label('date', 'Fecha', ['class' => 'h5']) !!}
            {!! Form::label('date', \Carbon\Carbon::parse($output->date)->format('d-m-Y'), [
                'class' => 'form-control mb-2',
            ]) !!}

        </div>
        <div class="card-body">
            <table class="table table-striped mt-5">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Cantidad</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productsAdd as $product)
                        <tr>
                            <td>{{ $product->product_name }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td width="10px">
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div>
                <a href="{{ route('admin.outputs.index') }}" class="btn btn-primary float-right mt-2">Volver</a>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    @livewireScripts
@stop
