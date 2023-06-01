@extends('adminlte::page')

@section('title', 'Entradas')

@section('content_header')
    <h1>Nueva entrada</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            {!! Form::token() !!}
            {!! Form::open(['route' => 'admin.inputs.store', 'method' => 'post']) !!}

            {!! Form::label('branch_id', 'Sucursal', ['class' => 'h5']) !!}
            {!! Form::select('branch_id', $branches, null, [
                'class' => 'form-control mb-2 select-city',
                'placeholder' => 'Seleccione una Sucursal',
            ]) !!}
            
            {!! Form::label('date', 'Fecha', ['class' => 'h5']) !!}
            {!! Form::date('date', null, ['class' => 'form-control mb-2']) !!}

            {!! Form::label('provider_id', 'Proveedor', ['class' => 'h5']) !!}
            {!! Form::select('provider_id', $providers, null, [
                'class' => 'form-control mb-2 select-city',
                'placeholder' => 'Seleccione un Proveedor',
            ]) !!}

            {!! Form::label('document_type_id', 'Tipo de Documento', ['class' => 'h5']) !!}
            {!! Form::select('document_type_id', $doc_types, null, [
                'class' => 'form-control mb-2 select-city',
                'placeholder' => 'Seleccione un tipo de Documento',
            ]) !!}

            {!! Form::label('doc_number', 'Número de Documento', ['class' => 'h5']) !!}
            {!! Form::number('doc_number', null, ['class' => 'form-control mb-2']) !!}

            
            {!! Form::submit('Guardar', ['class' => 'btn btn-primary mt-4']) !!}
            
            {!! Form::close() !!}

            {!! Form::label('productos', 'Productos', ['class' => 'h5 display: block mt-4 mb-4']) !!}         
            
            {!! Form::label('product_id', 'Nombre Producto', ['class' => 'h5']) !!}
            <select name="product_id" id="product_id" class="form-control" wire:model = "productSelect">
                <option value="0">Seleccione un Producto</option>
                @foreach ($products as $p)
                    <option value="{{$p->id}}">{{$p->name_id}}</option>                    
                @endforeach
            </select>

            {!! Form::label('quantity', 'Cantidad', ['class' => 'h5']) !!}
            {!! Form::number('quantity', null, ['class' => 'form-control mb-2']) !!}

            {!! Form::label('price', 'Precio Unitario', ['class' => 'h5']) !!}
            {!! Form::number('price', null, ['class' => 'form-control mb-2']) !!}

            <button wire:click="addProduct()" class="btn btn-primary mt-4">Agregar Producto</button>

            @if (empty($productsAdd))
                Nada                
            @endif

        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    @livewireScripts

@stop
