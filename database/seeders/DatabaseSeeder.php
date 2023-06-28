<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\GamesBoard;
use App\Models\Machine;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            CitySeeder::class,
            BranchSeeder::class,
            DocumentTypeSeeder::class,
            LoanStatesSeeder::class,
        ]);

        GamesBoard::create(['name' => 'Gaminator v1']);

        Machine::create([
            'name'  => 'Slot01',
            'state' => 0,
            'branch_id' => 1,
            'games_board_id' => 1,
            'value' => 200000
        ]);

        Machine::create([
            'name'  => 'Slot02',
            'state' => 0,
            'branch_id' => 1,
            'games_board_id' => 1,
            'value' => 200000
        ]);

        Machine::create([
            'name'  => 'Slot03',
            'state' => 0,
            'branch_id' => 1,
            'games_board_id' => 1,
            'value' => 200000
        ]);

        Machine::create([
            'name'  => 'Slot04',
            'state' => 0,
            'branch_id' => 1,
            'games_board_id' => 1,
            'value' => 200000
        ]);

        Machine::create([
            'name'  => 'Slot05',
            'state' => 0,
            'branch_id' => 1,
            'games_board_id' => 1,
            'value' => 200000
        ]);



        \App\Models\User::factory()->create([
            'name' => 'Administrador',
            'email' => 'Groupnuevavida@gmail.com',
            'password' => Hash::make('gnv20230627'),
        ])->assignRole('Administrador Total');
    }
}
