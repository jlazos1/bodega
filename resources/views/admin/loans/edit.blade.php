@extends('adminlte::page')

@section('title', 'Entradas')

@section('content_header')
    <h1>Nueva entrada</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            {!! Form::token() !!}
            {!! Form::open(['route' => ['admin.loans.update', $loan], 'method' => 'put']) !!}

            {!! Form::label('customer_id', 'Cliente', ['class' => 'h5']) !!}
            {!! Form::select('customer_id', $customers, $loan->customer_id, [
                'class' => 'form-control mb-2 select-city',
                'placeholder' => 'Seleccione un Cliente',
            ]) !!}
            @error('customer_id')
                <small style="color: red">{{ $message }}</small><br>
            @enderror

            <div class="mt-3">
                <div class="float-left mb-20" style='width: 49%'>

                    {!! Form::label('loan_date', 'Fecha Inicial', ['class' => 'h5']) !!}
                    {!! Form::date('loan_date', $loan->loan_date, ['class' => 'form-control mb-2']) !!}
                    @error('loan_date')
                        <small style="color: red">{{ $message }}</small><br>
                    @enderror
                </div>
                <div class="float-right" style='width: 49%'>

                    {!! Form::label('return_date', 'Fecha Final', ['class' => 'h5']) !!}
                    {!! Form::date('return_date', $loan->return_date, ['class' => 'form-control mb-2']) !!}
                    @error('return_date')
                        <small style="color: red">{{ $message }}</small><br>
                    @enderror
                </div>
            </div>

            {!! Form::submit('Siguiente', ['class' => 'btn btn-primary mt-4 float-right']) !!}


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
