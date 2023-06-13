@if (session('info'))
    <div class="alert alert-success">
        <strong>
            {{ session('info') }}
        </strong>
    </div>
@endif

<div>
    <a href="{{ route('admin.asset_sets.create') }}" class="btn btn-primary mb-2">Nuevo</a>
    <div class="card">
        <div class="card-header">
            <input wire:model="search" type="text" class="form-control" placeholder="Filtrar">
        </div>


        @if ($asset_sets->count())
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Máquina</th>
                            <th>Pantalla</th>
                            <th>Computador</th>
                            <th>IO Board</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($asset_sets as $set)
                            <tr>
                                <td>{{ $set->slot_name}}</td>
                                <td>{{ $set->screen_name }}</td>
                                <td>{{ $set->pc_name }}</td>
                                <td>{{ $set->card_name }}</td>
                                <td width="10px">
                                    <a href="{{ route('admin.asset_sets.edit', $set->id) }}"
                                        class="btn btn-primary fa fa-pen-to-square"></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $asset_sets->links() }}
            </div>
        @else
            <div class="card-body">
                <strong>No hay registros</strong>
            </div>
        @endif

    </div>
</div>
