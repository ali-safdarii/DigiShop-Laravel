<?php

namespace Database\Seeders;

use App\Utili\Helper;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

     /*   $valuesData = [
            [
                'product_id' => 1, // Replace with the ID of the product for this value
                'category_attribute_id' => 1, // Replace with the ID of the corresponding category attribute (e.g., Size)
                'value' => json_encode(['value' => 'XL', 'price_inc' => '760']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 1, // Replace with the ID of the product for this value
                'category_attribute_id' => 2, // Replace with the ID of the corresponding category attribute (e.g., Weight)
                'value' => json_encode(['value' => '1.5', 'price_inc' => '760']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 2, // Replace with the ID of the product for this value
                'category_attribute_id' => 3, // Replace with the ID of the corresponding category attribute (e.g., Color)
                'value' => json_encode(['value' => 'Red', 'price_inc' => '760']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 2, // Replace with the ID of the product for this value
                'category_attribute_id' => 4, // Replace with the ID of the corresponding category attribute (e.g., Material)
                'value' => json_encode(['value' => 'Leather', 'price_inc' => '760']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 3, // Replace with the ID of the product for this value
                'category_attribute_id' => 5, // Replace with the ID of the corresponding category attribute (e.g., Style)
                'value' => json_encode(['value' => 'Modern', 'price_inc' => '760']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('category_values')->insert($valuesData);*/

        $valuesData = [];

        for ($i = 1; $i <= Helper::$numberOfSeeder; $i++) {
            $valuesData[] = [
                'product_id' => random_int(1,Helper::$numberOfSeeder), // Replace with the ID of the product for this value
                'category_attribute_id' => random_int(1,Helper::$numberOfSeeder), // Replace with the ID of the corresponding category attribute (e.g., Style)
                'value' => json_encode(['value' => 'Modern', 'price_inc' => '76'.$i]),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }


        DB::table('category_values')->insert($valuesData);

    }
}
