<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('branches')->insert([
            'name' => 'Sucursal Santiago',
            'address' => 'Calle falsa 1020',
            'phone' => '9999993333',
            'city_id' => 127
        ]);

        DB::table('branches')->insert([
            'name' => 'Sucursal 14',
            'address' => 'Av. siempreviva 222',
            'phone' => '343321323',
            'city_id' => 22
        ]);

        DB::table('branches')->insert([
            'name' => 'Sucursal Pancracio',
            'address' => 'Av. Los pepes 1020',
            'phone' => '9933293333',
            'city_id' => 54
        ]);

        DB::table('branches')->insert([
            'name' => 'Sucursal Norte',
            'address' => 'Av. Chinchorro 123',
            'phone' => '4564993323',
            'city_id' => 3
        ]);
    }
}
