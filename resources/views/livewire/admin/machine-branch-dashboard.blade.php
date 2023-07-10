<div class="card" style="width: 30%">
    <div class="card-header">Máquinas por Sucursal</div>
    <div class="card-body mb-2">
        <select name="branches" id="branches" wire:model="branch" class="form-control select-branch">
            <option value="">Seleccione Sucursal</option>
            @foreach ($branches as $branch)
                <option value="{{ $branch->id }}">{{ $branch->name }}</option>
            @endforeach
        </select>
        <h1 class="text-center mt-3">
            @if ($count != "")
                {{ $count . ' Máquinas' }}
            @endif
        </h1>

    </div>
</div>
