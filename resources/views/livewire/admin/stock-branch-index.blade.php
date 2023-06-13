    <div>
        <div class="card">
            <div class="card-header">
                <input wire:model="search" type="text" class="form-control" placeholder="Filtrar">
            </div>

            @if ($products_branch->count())
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID Producto</th>
                                <th>Nombre</th>
                                <th>Stock</th>
                                <th>Sucursal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products_branch as $pr_br)
                                <tr>
                                    <td>{{ $pr_br->product_id }}</td>
                                    <td>{{ $pr_br->product_name }}</td>
                                    <td>{{ $pr_br->quantity }}</td>
                                    <td>{{ $pr_br->branch_name }}</td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{ $products_branch->links() }}
                </div>
            @else
                <div class="card-body">
                    <strong>No hay registros</strong>
                </div>
            @endif

        </div>
    </div>
