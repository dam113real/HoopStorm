<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;



class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Brand::create([
            'name' => 'Nike',
            'slug' => 'nike'
        ]);

        Brand::create([
            'name' => 'Jordan',
            'slug' => 'jordan'
        ]);

        Brand::create([
            'name' => 'Adidas',
            'slug' => 'adidas'
        ]);

        Brand::create([
            'name' => 'Under Armour',
            'slug' => 'under-armour'
        ]);

        Brand::create([
            'name' => 'Puma',
            'slug' => 'puma'
        ]);

        Brand::create([
            'name' => 'Reebok',
            'slug' => 'reebok'
        ]);
    }
}
