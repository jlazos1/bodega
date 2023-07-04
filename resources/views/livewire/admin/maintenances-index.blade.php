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


        @if ($maintenances->count())
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Fecha</th>
                            <th>Máquina</th>
                            <th>Encargado</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($maintenances as $maintenance)
                            <tr>
                                <td>{{ $maintenance->id }}</td>
                                <td>{{ \Carbon\Carbon::parse($maintenance->date)->format('d-m-Y') }}</td>
                                <td>{{ $maintenance->machine_name }}</td>
                                <td>{{ $maintenance->user_name }}</td>
                                <td width="10px">
                                    @can('admin.maintenances.show')
                                        <a href="{{ route('admin.maintenances.show', $maintenance->id) }}"
                                            class="btn btn-primary fa fa-eye"></a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $maintenances->links() }}
            </div>
        @else
            <div class="card-body">
                <strong>No hay registros</strong>
            </div>
        @endif

    </div>
</div>
