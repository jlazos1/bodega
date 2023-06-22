@if (session('info'))
    <div class="alert alert-success">
        <strong>
            {{ session('info') }}
        </strong>
    </div>
@endif

<div>
    <a href="{{ route('admin.loans.create') }}" class="btn btn-primary mb-2">Nuevo</a>
    <a href="{{ route('loans.checkReturn') }}" class="btn btn-primary mb-2 float-right">Comprobar Estado</a>

    <div class="card">
        <div class="card-header">
            <input wire:model="search" type="text" class="form-control mb-2" placeholder="Filtrar">
            <input wire:model="from_date" type="date" class="form-control mb-2" placeholder="Filtrar">
            <input wire:model="to_date" type="date" class="form-control" placeholder="Filtrar">
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
                                <td>{{ \Carbon\Carbon::parse($loan->loan_date)->format('d-m-Y')}}</td>
                                <td>{{ \Carbon\Carbon::parse($loan->return_date)->format('d-m-Y')}}</td>
                                <td>{{ $loan->loan_state_name}}</td>
                                <td style="display: flex;" class="float-right">
                                    @if ($loan->loan_state_id != 3)
                                        <a href="{{ route('loans.finishLoan', [$loan->id])}}" class="fa-solid fa-check-double btn btn-danger mr-2"></a>
                                        <a href="{{ route('admin.loans.edit', [$loan->id]) }}" class="btn btn-primary fa fa-pen-to-square"></a>
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
