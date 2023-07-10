@extends('adminlte::page')

@section('title', 'Entradas')

@section('content_header')
    <h1>Productos entrada</h1>
@stop
@section('content')
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="card pr-4 pl-4 pb-5">
        {!! Form::token() !!}
        {!! Form::open(['route' => 'admin.detalles-inputs.store', 'method' => 'post']) !!}

        {!! Form::label('productos', 'Productos', ['class' => 'h5 display: block mt-4 mb-4']) !!}

        {!! Form::label('product_id', 'Nombre Producto', ['class' => 'h5']) !!}
        {!! Form::select('product_id', $products, null, [
            'class' => 'form-control mb-2 select-product',
            'placeholder' => 'Seleccione un producto',
        ]) !!}
        @error('product_id')
            <small style="color: red">{{ $message }}</small><br>
        @enderror


        {!! Form::label('quantity', 'Cantidad', ['class' => 'h5']) !!}
        {!! Form::number('quantity', null, ['class' => 'form-control mb-2']) !!}
        @error('quantity')
            <small style="color: red">{{ $message }}</small><br>
        @enderror


        {!! Form::label('price', 'Precio Unitario', ['class' => 'h5']) !!}
        {!! Form::number('price', null, ['class' => 'form-control mb-2']) !!}
        @error('price')
            <small style="color: red">{{ $message }}</small><br>
        @enderror


        {!! Form::hidden('input_id', $input->id, ['class' => 'form-control mb-2']) !!}

        {!! Form::submit('Agregar', ['class' => 'btn btn-primary mt-4']) !!}

        {!! Form::close() !!}



        <div>
            <table class="table table-striped mt-5">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Cantidad</th>
                        <th>P. Unitario</th>
                        <th>Total</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productsAdd as $product)
                        <tr>
                            <td>{{ $product->product_name }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->price * $product->quantity }}</td>
                            <td width="10px">
                                <form action="{{ route('admin.detalles-inputs.destroy', $product->id) }}" method="POST">
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
            <a href="{{ route('admin.inputs.index') }}" class="btn btn-danger float-right">Finalizar</a>
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
            let select2 = $('.select-product').select2();
            select2.data('select2').$selection.css('height', '38px');
        });
    </script>

@stop
