@extends('adminlte::page')

@section('title', 'Entradas')

@section('content_header')
    <h1>Nueva entrada</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            {!! Form::token() !!}
            {!! Form::open(['route' => ['admin.inputs.update', $input], 'method' => 'put']) !!}

            {!! Form::label('branch_id', 'Sucursal', ['class' => 'h5']) !!}
            {!! Form::select('branch_id', $branches, $input->branch_id, [
                'class' => 'form-control mb-2 select-branch',
                'placeholder' => 'Seleccione una Sucursal',
            ]) !!}
            @error('branch_id')
                <small style="color: red">{{ $message }}</small><br>
            @enderror

            {!! Form::label('date', 'Fecha', ['class' => 'h5']) !!}
            {!! Form::date('date', $input->date, ['class' => 'form-control mb-2']) !!}
            @error('date')
                <small style="color: red">{{ $message }}</small><br>
            @enderror

            {!! Form::label('provider_id', 'Proveedor', ['class' => 'h5']) !!}
            {!! Form::select('provider_id', $providers, $input->provider_id, [
                'class' => 'form-control mb-2 select-provider',
                'placeholder' => 'Seleccione un Proveedor',
            ]) !!}
            @error('provider_id')
                <small style="color: red">{{ $message }}</small><br>
            @enderror

            {!! Form::label('document_type_id', 'Tipo de Documento', ['class' => 'h5']) !!}
            {!! Form::select('document_type_id', $doc_types, $input->document_type_id, [
                'class' => 'form-control mb-2 select-city',
                'placeholder' => 'Seleccione un tipo de Documento',
            ]) !!} @error('document_type_id')
                <small style="color: red">{{ $message }}</small><br>
            @enderror

            {!! Form::label('doc_number', 'Número de Documento', ['class' => 'h5']) !!}
            {!! Form::number('doc_number', $input->doc_number, ['class' => 'form-control mb-2']) !!}
            @error('doc_number')
                <small style="color: red">{{ $message }}</small><br>
            @enderror


            {!! Form::submit('Siguiente', ['class' => 'btn btn-primary mt-4']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    @livewireScripts
    <script>
        $(document).ready(function() {
            let select2 = $('.select-branch').select2();
            select2.data('select2').$selection.css('height', '38px');
        });

        $(document).ready(function() {
            let select2 = $('.select-provider').select2();
            select2.data('select2').$selection.css('height', '38px');
        });
    </script>

@stop
