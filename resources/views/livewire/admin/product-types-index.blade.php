@if (session('info'))
    <div class="alert alert-success">
        <strong>
            {{ session('info') }}
        </strong>
    </div>
@endif

<div>
    <a href="{{ route('admin.product_types.create') }}" class="btn btn-primary mb-2">Nuevo</a>
    <div class="card">
        <div class="card-header">
            <input wire:model="search" type="text" class="form-control" placeholder="Filtrar">
        </div>


        @if ($product_types->count())
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($product_types as $prd_type)
                            <tr>
                                <td>{{ $prd_type->id }}</td>
                                <td>{{ $prd_type->name }}</td>
                                <td width="10px">
                                    <a href="{{ route('admin.product_types.edit', $prd_type->id) }}" class="btn btn-primary fa fa-pen-to-square"></a>
                                    
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $product_types->links() }}
            </div>
        @else
            <div class="card-body">
                <strong>No hay registros</strong>
            </div>
        @endif

    </div>
</div>
