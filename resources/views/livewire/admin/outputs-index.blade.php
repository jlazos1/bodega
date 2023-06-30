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
            <input wire:model="search" type="text" class="form-control mb-2" placeholder="Filtrar">
            <input wire:model="from_date" type="date" class="form-control mb-2" placeholder="Filtrar">
            <input wire:model="to_date" type="date" class="form-control" placeholder="Filtrar">
        </div>


        @if ($outputs->count())
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
                        @foreach ($outputs as $output)
                            <tr>
                                <td>{{ $output->id }}</td>
                                <td>{{ \Carbon\Carbon::parse($output->date)->format('d-m-Y') }}</td>
                                <td>{{ $output->origin_branch_name }}</td>
                                <td>{{ $output->destination_branch_name }}</td>
                                <td style="display: flex;" class="float-right">
                                    @can('admin.outputs.show')
                                        <a href="{{ route('admin.outputs.show', [$output->id]) }}"
                                            class="btn btn-primary fa fa-eye mr-2" title="Ver"></a>
                                    @endcan
                                    @can('admin.outputs.edit')
                                        <a href="{{ route('admin.outputs.edit', [$output->id]) }}"
                                            class="btn btn-primary fa fa-pen-to-square" title="Editar"></a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $outputs->links() }}
            </div>
        @else
            <div class="card-body">
                <strong>No hay registros</strong>
            </div>
        @endif
    </div>
</div>
