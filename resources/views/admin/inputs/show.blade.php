@extends('adminlte::page')

@section('title', 'Entradas')

@section('content_header')
    <h1>Entrada</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">

            {!! Form::label('branch_id', 'Sucursal', ['class' => 'h5']) !!}
            {!! Form::label('branch_id', $branch_name, ['class' => 'form-control mb-2']) !!}

            {!! Form::label('date', 'Fecha', ['class' => 'h5']) !!}
            {!! Form::label('date', \Carbon\Carbon::parse($input->date)->format('d-m-Y'), ['class' => 'form-control mb-2']) !!}

            {!! Form::label('provider_id', 'Proveedor', ['class' => 'h5']) !!}
            {!! Form::label('date', $provider_name, ['class' => 'form-control mb-2']) !!}

            {!! Form::label('document_type_id', 'Tipo de Documento', ['class' => 'h5']) !!}
            {!! Form::label('date', $type_doc, ['class' => 'form-control mb-2']) !!}

            {!! Form::label('doc_number', 'Número de Documento', ['class' => 'h5']) !!}
            @if ($input->doc_number == null)
                {!! Form::label('date', 'Sin Información', ['class' => 'form-control mb-2']) !!}
            @else
                {!! Form::label('date', $input->doc_number, ['class' => 'form-control mb-2']) !!}
            @endif

        </div>

        <div class="card-body">
            <h2>Productos</h2>
            <table class="table table-striped mt-2">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Cantidad</th>
                        <th>P. Unitario</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productsAdd as $product)
                        <tr>
                            <td>{{ $product->product_name }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->price * $product->quantity }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    @livewireScripts
@stop
