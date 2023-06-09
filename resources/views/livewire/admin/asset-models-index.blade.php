@if (session('info'))
    <div class="alert alert-success">
        <strong>
            {{ session('info') }}
        </strong>
    </div>
@endif

<div>
    <a href="{{ route('admin.asset_models.create') }}" class="btn btn-primary mb-2">Nuevo</a>
    <div class="card">
        <div class="card-header">
            <input wire:model="search" type="text" class="form-control" placeholder="Filtrar">
        </div>


        @if ($asset_models->count())
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Tipo de Activo</th>
                            <th>Descripción</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($asset_models as $am)
                            <tr>
                                <td>{{ $am->id }}</td>
                                <td>{{ $am->name }}</td>
                                <td>{{ $am->asset_type_name}}</td>
                                <td> <a href="">Descripcion</a></td>
                                <td width="10px">
                                    <a href="{{ route('admin.asset_models.edit', $am->id) }}" class="btn btn-primary fa fa-pen-to-square"></a>
                                    <form action="{{ route('admin.asset_models.destroy', $am->id) }}" method="POST">
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
            <div class="card-footer">
                {{ $asset_models->links() }}
            </div>
        @else
            <div class="card-body">
                <strong>No hay registros</strong>
            </div>
        @endif

    </div>
</div>
