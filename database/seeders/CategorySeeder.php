<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'Ropa',
            'slug' => 'ropa'
        ]);

        Category::create([
            'name' => 'Calzado',
            'slug' => 'calzado'
        ]);

        Category::create([
            'name' => 'Accesorios',
            'slug' => 'accesorios'
        ]);

        Category::create([
            'name' => 'Equipamiento',
            'slug' => 'equipamiento'
        ]);
    }
}
