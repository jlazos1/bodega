@if (session('info'))
    <div class="alert alert-success">
        <strong>
            {{ session('info') }}
        </strong>
    </div>
@endif

<div>
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary mb-2">Nuevo</a>
    <div class="card">
        <div class="card-header">
            <input wire:model="search" type="text" class="form-control" placeholder="Filtrar">
        </div>


        @if ($products->count())
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Valor</th>
                            <th>Categoría</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->product_type_name }}</td>
                                <td width="10px">
                                    <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-primary fa fa-pen-to-square"></a>
                                    <!--<form action="{{ route('admin.products.destroy', $product->id) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-danger fa fa-trash"></button>
                                    </form>-->
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $products->links() }}
            </div>
        @else
            <div class="card-body">
                <strong>No hay registros</strong>
            </div>
        @endif

    </div>
</div>
