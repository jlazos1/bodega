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

        \App\Models\User::factory()->create([
            'name' => 'JL',
            'email' => 'jlazos@live.com',
            'password' => Hash::make('18jls210_'),
        ])->assignRole('Administrador Total');
    }
}
