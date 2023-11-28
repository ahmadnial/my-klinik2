<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        Role::create([
            'hakakses' => 'SPRADMIN',
        ]);

        Role::create([
            'hakakses' => 'DKTR',
        ]);

        Role::create([
            'hakakses' => 'PRWT',
        ]);

        Role::create([
            'hakakses' => 'APTKR',
        ]);

        Role::create([
            'hakakses' => 'RM',
        ]);

        User::factory(5)->create();
    }
}
