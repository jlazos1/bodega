<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::create(['name' => 'Administrador Total']);
        $inventario = Role::create(['name' => 'Administrador de Inventario']);
        $tecnico = Role::create(['name' => 'Tecnico']);
        
        Permission::create(['name' => 'admin.users.index'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.users.create'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.users.edit'])->syncRoles([$admin]);

        Permission::create(['name' => 'admin.branches.index'])->syncRoles([$admin, $tecnico]);
        Permission::create(['name' => 'admin.branches.create'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.branches.edit'])->syncRoles([$admin]);

        Permission::create(['name' => 'admin.providers.index'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.providers.create'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.providers.edit'])->syncRoles([$admin]);

        Permission::create(['name' => 'admin.customers.index'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.customers.create'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.customers.edit'])->syncRoles([$admin]);

        Permission::create(['name' => 'admin.asset_types.index'])->syncRoles([$admin, $tecnico]);
        Permission::create(['name' => 'admin.asset_types.create'])->syncRoles([$admin, $tecnico]);
        Permission::create(['name' => 'admin.asset_types.edit'])->syncRoles([$admin, $tecnico]);

        Permission::create(['name' => 'admin.asset_models.index'])->syncRoles([$admin, $tecnico]);
        Permission::create(['name' => 'admin.asset_models.create'])->syncRoles([$admin, $tecnico]);
        Permission::create(['name' => 'admin.asset_models.edit'])->syncRoles([$admin, $tecnico]);

        Permission::create(['name' => 'admin.assets.index'])->syncRoles([$admin, $tecnico]);
        Permission::create(['name' => 'admin.assets.create'])->syncRoles([$admin, $tecnico]);
        Permission::create(['name' => 'admin.assets.edit'])->syncRoles([$admin, $tecnico]);

        Permission::create(['name' => 'admin.machines.index'])->syncRoles([$admin, $tecnico]);
        Permission::create(['name' => 'admin.machines.create'])->syncRoles([$admin, $tecnico]);
        Permission::create(['name' => 'admin.machines.edit'])->syncRoles([$admin, $tecnico]);

        Permission::create(['name' => 'admin.product_types.index'])->syncRoles([$admin, $tecnico]);
        Permission::create(['name' => 'admin.product_types.create'])->syncRoles([$admin, $tecnico]);
        Permission::create(['name' => 'admin.product_types.edit'])->syncRoles([$admin, $tecnico]);

        Permission::create(['name' => 'admin.products.index'])->syncRoles([$admin, $tecnico]);
        Permission::create(['name' => 'admin.products.create'])->syncRoles([$admin, $tecnico]);
        Permission::create(['name' => 'admin.products.edit'])->syncRoles([$admin, $tecnico]);

        Permission::create(['name' => 'admin.inputs.index'])->syncRoles([$admin, $inventario]);
        Permission::create(['name' => 'admin.inputs.create'])->syncRoles([$admin, $inventario]);
        Permission::create(['name' => 'admin.inputs.edit'])->syncRoles([$admin, $inventario]);

        Permission::create(['name' => 'admin.outputs.index'])->syncRoles([$admin, $inventario]);
        Permission::create(['name' => 'admin.outputs.create'])->syncRoles([$admin, $inventario]);
        Permission::create(['name' => 'admin.outputs.edit'])->syncRoles([$admin, $inventario]);

        Permission::create(['name' => 'admin.detalles-inputs.index'])->syncRoles([$admin, $inventario]);
        Permission::create(['name' => 'admin.detalles-inputs.create'])->syncRoles([$admin, $inventario]);
        Permission::create(['name' => 'admin.detalles-inputs.edit'])->syncRoles([$admin, $inventario]);
        Permission::create(['name' => 'admin.detalles-inputs.destroy'])->syncRoles([$admin, $inventario]);

        Permission::create(['name' => 'admin.detalles-outputs.index'])->syncRoles([$admin, $inventario]);
        Permission::create(['name' => 'admin.detalles-outputs.create'])->syncRoles([$admin, $inventario]);
        Permission::create(['name' => 'admin.detalles-outputs.edit'])->syncRoles([$admin, $inventario]);
        Permission::create(['name' => 'admin.detalles-outputs.destroy'])->syncRoles([$admin, $inventario]);

        Permission::create(['name' => 'admin.detalles-relocations.index'])->syncRoles([$admin, $tecnico]);
        Permission::create(['name' => 'admin.detalles-relocations.create'])->syncRoles([$admin, $tecnico]);
        Permission::create(['name' => 'admin.detalles-relocations.edit'])->syncRoles([$admin, $tecnico]);
        Permission::create(['name' => 'admin.detalles-relocations.destroy'])->syncRoles([$admin, $tecnico]);

        Permission::create(['name' => 'admin.machines-details-relocations.index'])->syncRoles([$admin, $tecnico]);
        Permission::create(['name' => 'admin.machines-details-relocations.create'])->syncRoles([$admin, $tecnico]);
        Permission::create(['name' => 'admin.machines-details-relocations.edit'])->syncRoles([$admin, $tecnico]);
        Permission::create(['name' => 'admin.machines-details-relocations.destroy'])->syncRoles([$admin, $tecnico]);

        Permission::create(['name' => 'admin.relocations.index'])->syncRoles([$admin, $tecnico]);
        Permission::create(['name' => 'admin.relocations.create'])->syncRoles([$admin, $tecnico]);
        Permission::create(['name' => 'admin.relocations.show'])->syncRoles([$admin, $tecnico]);

        Permission::create(['name' => 'admin.machines-relocations.index'])->syncRoles([$admin, $tecnico]);
        Permission::create(['name' => 'admin.machines-relocations.create'])->syncRoles([$admin, $tecnico]);
        Permission::create(['name' => 'admin.machines-relocations.show'])->syncRoles([$admin, $tecnico]);

        Permission::create(['name' => 'admin.game-boards.index'])->syncRoles([$admin, $tecnico]);
        Permission::create(['name' => 'admin.game-boards.create'])->syncRoles([$admin, $tecnico]);
        Permission::create(['name' => 'admin.game-boards.edit'])->syncRoles([$admin, $tecnico]);
        Permission::create(['name' => 'admin.game-boards.show'])->syncRoles([$admin, $tecnico]);

        Permission::create(['name' => 'admin.loans.index'])->syncRoles([$admin, $tecnico]);
        Permission::create(['name' => 'admin.loans.create'])->syncRoles([$admin, $tecnico]);
        Permission::create(['name' => 'admin.loans.edit'])->syncRoles([$admin, $tecnico]);
        Permission::create(['name' => 'admin.loans.show'])->syncRoles([$admin, $tecnico]);

        Permission::create(['name' => 'admin.detalles-loans.index'])->syncRoles([$admin, $tecnico]);
        Permission::create(['name' => 'admin.detalles-loans.create'])->syncRoles([$admin, $tecnico]);
        Permission::create(['name' => 'admin.detalles-loans.edit'])->syncRoles([$admin, $tecnico]);
        Permission::create(['name' => 'admin.detalles-loans.destroy'])->syncRoles([$admin, $tecnico]);

        Permission::create(['name' => 'admin.maintenances.index'])->syncRoles([$admin, $tecnico]);
        Permission::create(['name' => 'admin.maintenances.create'])->syncRoles([$admin, $tecnico]);
        Permission::create(['name' => 'admin.maintenances.edit'])->syncRoles([$admin, $tecnico]);
        Permission::create(['name' => 'admin.maintenances.show'])->syncRoles([$admin, $tecnico]);

        Permission::create(['name' => 'admin.products_branch.index'])->syncRoles([$admin, $inventario]);

        Permission::create(['name' => 'loans.checkReturn'])->syncRoles([$admin, $tecnico]);
        Permission::create(['name' => 'loans.finishLoan'])->syncRoles([$admin, $tecnico]);

        Permission::create(['name' => 'details_relocations'])->syncRoles([$admin, $tecnico]);
        Permission::create(['name' => 'details_inputs'])->syncRoles([$admin, $inventario]);
        Permission::create(['name' => 'details_loans'])->syncRoles([$admin, $tecnico]);
        Permission::create(['name' => 'details_outputs'])->syncRoles([$admin, $inventario]);
        Permission::create(['name' => 'details-machine-relocations'])->syncRoles([$admin, $tecnico]);
        Permission::create(['name' => 'qrcode'])->syncRoles([$admin, $tecnico]);


        

    }
}
