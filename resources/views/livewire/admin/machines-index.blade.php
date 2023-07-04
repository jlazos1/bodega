@if (session('info'))
    <div class="alert alert-success">
        <strong>
            {{ session('info') }}
        </strong>
    </div>
@endif

<div>
    <div class="card">
        <div class="card-header">
            <input wire:model="search" type="text" class="form-control" placeholder="Filtrar">
        </div>


        @if ($machines->count())
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Sucursal</th>
                            <th>T. Juegos</th>
                            <th>Código QR</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($machines as $machine)
                            <tr>
                                <td>{{ $machine->id }}</td>
                                <td>{{ $machine->name }}</td>
                                <td>{{ $machine->branch_name }}</td>
                                <td>{{ $machine->games_board_name }}</td>
                                <td> <a href="{{ route('qrcode', [$machine->id]) }}" target="_blank"
                                        class="btn btn-info fa fa-qrcode"></a></td>
                                <td style="display: flex;" class="float-right">
                                    @can('admin.machines.show')
                                        <a href="{{ route('admin.machines.show', [$machine->id]) }}"
                                            class="btn btn-primary fa fa-eye mr-2" title="Ver"></a>
                                    @endcan
                                    @can('admin.machines.edit')
                                        <a href="{{ route('admin.machines.edit', [$machine->id]) }}"
                                            class="btn btn-primary fa fa-pen-to-square mr-2" title="Editar"></a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $machines->links() }}
            </div>
        @else
            <div class="card-body">
                <strong>No hay registros</strong>
            </div>
        @endif

    </div>
</div>
