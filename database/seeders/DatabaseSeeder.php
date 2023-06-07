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
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Super Admin ',
            'email' => 'admin@example.com',
            'username' => 'hmadilkhan',
            'password' => Hash::make("1234"),
        ]);

        \Spatie\Permission\Models\Role::create([
            'name' => 'Super Admin',
        ]);

        \Spatie\Permission\Models\Role::create([
            'name' => 'Admin',
        ]);

        \Spatie\Permission\Models\Role::create([
            'name' => 'Sales Person ',
        ]);
    }
}
