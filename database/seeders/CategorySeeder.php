<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Jalan Desa', 'slug' => 'jalan-desa', 'description' => 'Kerusakan jalan, jembatan, gorong-gorong', 'icon' => 'road'],
            ['name' => 'Penerangan Umum', 'slug' => 'penerangan-umum', 'description' => 'Lampu jalan, instalasi listrik umum', 'icon' => 'lightbulb'],
            ['name' => 'Air Bersih', 'slug' => 'air-bersih', 'description' => 'PDAM, sumur umum, saluran air', 'icon' => 'droplet'],
            ['name' => 'Irigasi & Drainase', 'slug' => 'irigasi-drainase', 'description' => 'Saluran irigasi, selokan, drainase', 'icon' => 'waves'],
            ['name' => 'Fasilitas Umum', 'slug' => 'fasilitas-umum', 'description' => 'Balai desa, lapangan, taman, MCK umum', 'icon' => 'building'],
            ['name' => 'Limbah & Kebersihan', 'slug' => 'limbah-kebersihan', 'description' => 'TPS, pengangkutan sampah, limbah', 'icon' => 'trash'],
            ['name' => 'Lainnya', 'slug' => 'lainnya', 'description' => 'Sarana desa lainnya', 'icon' => 'other'],
        ];

        foreach ($categories as $category) {
            \App\Models\Category::create($category);
        }
    }
}
