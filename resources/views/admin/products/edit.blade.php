@extends('adminlte::page')

@section('title', 'Producto')

@section('content_header')
    <h1>Editar Producto</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            {!! Form::token() !!}
            {!! Form::open(['route' => ['admin.products.update', $product], 'method' => 'put']) !!}

            {!! Form::label('name', 'Nombre', ['class' => 'h5']) !!}
            {!! Form::text('name', $product->name, ['class' => 'form-control mb-2']) !!}

            {!! Form::label('price', 'Valor', ['class' => 'h5']) !!}
            {!! Form::number('price', $product->price, ['class' => 'form-control mb-2']) !!}

            {!! Form::label('product_type_id', 'Tipo de Producto', ['class' => 'h5']) !!}
            {!! Form::select('product_type_id', $product_types, $product->product_type_id, [
                'class' => 'form-control mb-2',
                'placeholder' => 'Seleccione un tipo de Producto',
            ]) !!}

            {!! Form::submit('Guardar', ['class' => 'btn btn-primary mt-4']) !!}

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