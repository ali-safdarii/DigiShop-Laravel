<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colorsData = [
            [
                'name' => 'Red',
                'color_code' => '#FF0000',
                'price_increase' => 5.0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Green',
                'color_code' => '#00FF00',
                'price_increase' => 3.0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Blue',
                'color_code' => '#0000FF',
                'price_increase' => 2.5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Yellow',
                'color_code' => '#FFFF00',
                'price_increase' => 4.0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Black',
                'color_code' => '#000000',
                'price_increase' => 0.0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('colors')->insert($colorsData);

    }
}
