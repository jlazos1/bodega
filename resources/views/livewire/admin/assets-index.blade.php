@if (session('info'))
    <div class="alert alert-success">
        <strong>
            {{ session('info') }}
        </strong>
    </div>
@endif

<div>
    <a href="{{ route('admin.assets.create') }}" class="btn btn-primary mb-2">Nuevo</a>
    <div class="card">
        <div class="card-header">
            <input wire:model="search" type="text" class="form-control" placeholder="Filtrar">
        </div>


        @if ($assets->count())
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Sucursal</th>
                            <th>Modelos de Activo</th>
                            <th>Código QR</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($assets as $asset)
                            <tr>
                                <td>{{ $asset->id }}</td>
                                <td>{{ $asset->name }}</td>
                                <td>{{ $asset->branch_name}}</td>
                                <td>{{ $asset->asset_model_name}}</td>
                                <td> <a href="{{ route('qrcode', [$asset->id]) }}" target="_blank">Ver</a></td>
                                <td width="10px">
                                    <a href="{{ route('admin.assets.edit', [$asset->id]) }}" class="btn btn-primary fa fa-pen-to-square"></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $assets->links() }}
            </div>
        @else
            <div class="card-body">
                <strong>No hay registros</strong>
            </div>
        @endif

    </div>
</div>
