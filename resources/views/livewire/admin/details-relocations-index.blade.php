@extends('adminlte::page')

@section('title', 'Traslados')

@section('content_header')
    <h1>Traslados</h1>
@stop
@section('content')
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    @if (session('correct'))
        <div class="alert alert-success">
            {{ session('correct') }}
        </div>
    @endif
    <div class="card pr-4 pl-4 pb-5">
        {!! Form::token() !!}
        {!! Form::open(['route' => 'admin.detalles-relocations.store', 'method' => 'post']) !!}

        {!! Form::label('assets', 'Activos', ['class' => 'h5 display: block mt-4 mb-4']) !!}

        {!! Form::label('asset_id', 'Nombre Activo', ['class' => 'h5']) !!}
        {!! Form::select('asset_id', $assets, null, [
            'class' => 'form-control mb-2 select-asset',
            'multiple' => 'multiple',
            'name' => 'seleccion[]',
        ]) !!}

        {!! Form::hidden('relocation_id', $relocation_id, ['class' => 'form-control mb-2']) !!}

        {!! Form::submit('Agregar', ['class' => 'btn btn-primary mt-4']) !!}

        {!! Form::close() !!}

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
                    @foreach ($assetsAdd as $asse)
                        <tr>
                            <td>{{ $asse->asset_id }}</td>
                            <td>{{ $asse->asset_name }}</td>
                            <td width="10px">
                                <form action="{{ route('admin.detalles-outputs.destroy', $asse->id) }}" method="POST">
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
            <a href="{{ route('admin.relocations.index') }}" class="btn btn-danger float-right">Finalizar</a>
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
            let select2 = $('.select-asset').select2();
            select2.data('select2').$selection.css('height', '38px');
        });
    </script>
@stop
