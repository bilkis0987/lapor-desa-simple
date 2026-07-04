<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
        ]);

        User::factory()->create([
            'name' => 'Admin Desa',
            'email' => 'admin@desa.com',
            'password' => bcrypt('password'),
        ]);
    }
}

// TODO: Add sample complaints