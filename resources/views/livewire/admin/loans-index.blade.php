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
            <div class="mt-3">
                <div class="float-left mb-20" style='width: 49%'>
                    <label for="">Fecha Inicial</label>
                    <input wire:model="from_date" type="date" class="form-control mb-2" placeholder="Filtrar">
                </div>
                <div class="float-right" style='width: 49%'>
                    <label for="">Fecha Final</label>
                    <input wire:model="to_date" type="date" class="form-control" placeholder="Filtrar">
                </div>
            </div>
        </div>


        @if ($loans->count())
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Cliente</th>
                            <th>Fecha Inicio</th>
                            <th>Fecha Fin</th>
                            <th>Estado</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($loans as $loan)
                            <tr>
                                <td>{{ $loan->id }}</td>
                                <td>{{ $loan->customer_name }}</td>
                                <td>{{ \Carbon\Carbon::parse($loan->loan_date)->format('d-m-Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($loan->return_date)->format('d-m-Y') }}</td>
                                <td>{{ $loan->loan_state_name }}</td>
                                <td style="display: flex;" class="float-right">
                                    @can('admin.loans.show')
                                        <a href="{{ route('admin.loans.show', [$loan->id]) }}"
                                            class="btn btn-primary fa fa-eye mr-2" title="Ver"></a>
                                    @endcan
                                    @if ($loan->loan_state_id != 3)
                                        @can('loans.finishLoan')
                                            <a href="{{ route('loans.finishLoan', [$loan->id]) }}"
                                                class="fa-solid fa-check-double btn btn-danger mr-2" title="Finalizar Arriendo"></a>
                                        @endcan
                                        @can('admin.loans.edit')
                                            <a href="{{ route('admin.loans.edit', [$loan->id]) }}"
                                                class="btn btn-primary fa fa-pen-to-square mr-2" title="Editar"></a>
                                        @endcan
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $loans->links() }}
            </div>
        @else
            <div class="card-body">
                <strong>No hay registros</strong>
            </div>
        @endif
    </div>
</div>
