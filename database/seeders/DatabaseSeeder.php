<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        \App\Models\User::factory()->create([
            'name' => 'Administrador',
            'email' => 'admin@admin.cl',
            'password' => Hash::make('asdasdasd'),
        ]);
        
        \App\Models\User::factory(40)->create();

        $this->call([
            RoleSeeder::class,
            CitySeeder::class
        ]);
    }
}
