@if (session('info'))
    <div class="alert alert-success">
        <strong>
            {{ session('info') }}
        </strong>
    </div>
@endif

<div>
    <a href="{{ route('admin.machines-relocations.create') }}" class="btn btn-primary mb-2">Nuevo</a>
    <div class="card">
        <div class="card-header">
            <input wire:model="search" type="text" class="form-control" placeholder="Filtrar">
        </div>

        @if ($relocations->count())
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Fecha</th>
                            <th>Origen</th>
                            <th>Destino</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($relocations as $relo)
                            <tr>
                                <td>{{ $relo->id }}</td>
                                <td>{{ $relo->date }}</td>
                                <td>{{ $relo->origin_name }}</td>
                                <td>{{ $relo->destination_name }}</td>
                                <td width="10px">
                                    <a href="{{ route('admin.machines-relocations.show', $relo->id) }}"
                                        class="btn btn-primary fa fa-eye"></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $relocations->links() }}
            </div>
        @else
            <div class="card-body">
                <strong>No hay registros</strong>
            </div>
        @endif

    </div>
</div>