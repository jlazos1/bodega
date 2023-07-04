@extends('adminlte::page')

@section('title', 'Máquinas')

@section('content_header')
    <h1>Máquina</h1>
@stop

@section('content')

    <div class="card">
        <!-- INFORMACIÓN DE LA MÁQUINAS -->
        <div class="card-body">
            {!! Form::label('name', 'Nombre', ['class' => 'h5']) !!}
            {!! Form::label('name', $machine->name, ['class' => ' form-control h5 mb-2']) !!}

            {!! Form::label('value', 'Valor Monetario', ['class' => 'h5']) !!}
            {!! Form::label('name', $machine->value, ['class' => 'form-control h5 mb-2']) !!}

            {!! Form::label('games_board_id', 'Tarjeta de Juego', ['class' => 'h5']) !!}
            {!! Form::label('name', $game_board, ['class' => 'form-control h5 mb-2']) !!}

            {!! Form::label('branch_id', 'Sucursal', ['class' => 'h5 mt-2']) !!}
            {!! Form::label('name', $branch_name, ['class' => 'form-control h5 mb-2']) !!}
        </div>
    </div>

    <!-- INFORMACIÓN DE TRASLADOS -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Traslados</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body" style="display: block;">
            <div class="card-body">
                @if ($relocations->count())
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID Traslado</th>
                                <th>Fecha</th>
                                <th>Origen</th>
                                <th>Destino</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($relocations as $relo)
                                <tr>
                                    <td>{{ $relo->id }}</td>
                                    <td>{{ $relo->date }}</td>
                                    <td>{{ $relo->origin_name }}</td>
                                    <td>{{ $relo->destination_name }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="card-body">
                        <strong>No hay registros</strong>
                    </div>
                @endif
            </div>
        </div>
    </div>


    <!-- INFORMACIÓN DE ARRIENDOS -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Arriendos</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>

            </div>
        </div>
        <div class="card-body" style="display: block;">
            <div class="card-body">
                @if ($loans->count())
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID Arriendo</th>
                                <th>Cliente</th>
                                <th>Fecha Inicial</th>
                                <th>Fecha Final</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($loans as $loan)
                                <tr>
                                    <td>{{ $loan->id }}</td>
                                    <td>{{ $loan->customer_name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($loan->loan_date)->format('d-m-Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($loan->return_date)->format('d-m-Y') }}</td>
                                    <td>{{ $loan->loan_state_name }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="card-body">
                        <strong>No hay registros</strong>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- INFORMACIÓN DE MANTENIMIENTOS -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Mantenimientos</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>

            </div>
        </div>
        <div class="card-body" style="display: block;">
            <div class="card-body">
                @if ($maintenances->count())
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Fecha</th>
                                <th>Encargado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($maintenances as $maintenance)
                                <tr>
                                    <td>{{ $maintenance->id }}</td>
                                    <td>{{ \Carbon\Carbon::parse($maintenance->date)->format('d-m-Y') }}</td>
                                    <td>{{ $maintenance->user_name }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="card-body">
                        <strong>No hay registros</strong>
                    </div>
                @endif
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
