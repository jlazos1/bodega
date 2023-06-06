@extends('adminlte::page')

@section('title', 'Entradas')

@section('content_header')
    <h1>Productos entrada</h1>
@stop
@section('content')

    <div class="card pr-4 pl-4 pb-5">
        {!! Form::token() !!}
        {!! Form::open(['route' => 'admin.detalles-outputs.store', 'method' => 'post']) !!}

        {!! Form::label('productos', 'Productos', ['class' => 'h5 display: block mt-4 mb-4']) !!}

        {!! Form::label('product_id', 'Nombre Producto', ['class' => 'h5']) !!}
        <select name="product_id" id="product_id" class="form-control">
            <option value="0">Seleccione un Producto</option>
            @foreach ($products as $p)
                <option value="{{ $p->id }}">{{ $p->name_id }}</option>
            @endforeach
        </select>

        {!! Form::label('quantity', 'Cantidad', ['class' => 'h5']) !!}
        {!! Form::number('quantity', null, ['class' => 'form-control mb-2']) !!}

        {!! Form::hidden('output_id', $output->id, ['class' => 'form-control mb-2']) !!}

        {!! Form::submit('Agregar', ['class' => 'btn btn-primary mt-4']) !!}
 
        {!! Form::close() !!}

        <a href="{{ route('admin.outputs.index')}}" class="btn btn-danger">Finalizar</a>

        <div>
            <table class="table table-striped mt-5">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Cantidad</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productsAdd as $product)
                        <tr>
                            <td>{{ $product->product_name}}</td>
                            <td>{{ $product->quantity }}</td>
                            <td width="10px">
                                <form action="{{ route('admin.detalles-outputs.destroy', $product->id) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop


@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    @livewireScripts

@stop
