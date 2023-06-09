@if (session('info'))
    <div class="alert alert-success">
        <strong>
            {{ session('info') }}
        </strong>
    </div>
@endif

<div>
    <a href="{{ route('admin.inputs.create') }}" class="btn btn-primary mb-2">Nuevo</a>
    <div class="card">
        <div class="card-header">
            <input wire:model="search" type="text" class="form-control mb-2" placeholder="Filtrar">
            <input wire:model="from_date" type="date" class="form-control mb-2" placeholder="Filtrar">
            <input wire:model="to_date" type="date" class="form-control" placeholder="Filtrar">
        </div>

        
        @if ($inputs->count())
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Proveedor</th>
                            <th>Sucursal</th>
                            <th>Tipo Doc.</th>
                            <th>Nro Doc.</th>
                            <th>Fecha</th>
                            <th>Monto Neto</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($inputs as $input)
                            <tr>
                                <td>{{ $input->id }}</td>
                                <td>{{ $input->provider_name }}</td>
                                <td>{{ $input->branch_name}}</td>
                                <td>{{ $input->document_type_name}}</td>
                                <td>{{ $input->doc_number}}</td>
                                <td>{{ \Carbon\Carbon::parse($input->date)->format('d-m-Y')}}</td>
                                <td>{{ $input->net_amount}}</td>
                                <td width="10px">
                                    <a href="{{ route('admin.inputs.edit', [$input->id]) }}" class="btn btn-primary fa fa-pen-to-square"></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $inputs->links() }}
            </div>
        @else
            <div class="card-body">
                <strong>No hay registros</strong>
            </div>
        @endif
    </div>
</div>
