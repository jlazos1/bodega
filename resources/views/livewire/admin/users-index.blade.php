@if (session('info'))
    <div class="alert alert-success">
        <strong>
            {{ session('info') }}
        </strong>
    </div>
@endif
<div>
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary mb-2">Nuevo</a>
    <div class="card">
        <div class="card-header">
            <input wire:model="search" type="text" class="form-control" placeholder="Filtrar">
        </div>


        @if ($users->count())
            <div class="card-body">
                <table class="table table-striped table-users">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Sucursal</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                @if ($user->branch_name != null)
                                    <td>{{ $user->branch_name }}</td>
                                @else
                                    <td>Sin Asignar</td>
                                @endif

                                <td width="10px">
                                    <a href="{{ route('admin.users.edit', $user->id) }}"
                                        class="btn btn-primary fa fa-pen-to-square"></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $users->links() }}
            </div>
        @else
            <div class="card-body">
                <strong>No hay registros</strong>
            </div>
        @endif

    </div>
</div>
