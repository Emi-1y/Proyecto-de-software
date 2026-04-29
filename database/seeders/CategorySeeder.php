<?php

// Author: Equipo Raíces

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name'        => 'Plantas',
                'description' => 'Plantas ornamentales, de interior y exterior.',
            ],
            [
                'name'        => 'Semillas',
                'description' => 'Semillas certificadas de hortalizas, flores y hierbas aromáticas.',
            ],
            [
                'name'        => 'Abonos y Fertilizantes',
                'description' => 'Compost orgánico, fertilizantes líquidos y sustratos.',
            ],
            [
                'name'        => 'Herramientas',
                'description' => 'Tijeras de poda, palas, regaderas y accesorios de jardinería.',
            ],
            [
                'name'        => 'Macetas y Decoración',
                'description' => 'Macetas de barro, cerámica, madera y accesorios decorativos.',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
