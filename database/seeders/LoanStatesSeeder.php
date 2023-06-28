<?php

namespace Database\Seeders;

use App\Models\LoanState;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LoanStatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LoanState::create(['name' => 'Arrendado']);
        LoanState::create(['name' => 'Atrasado']);
        LoanState::create(['name' => 'Finalizado']);
    }
}
