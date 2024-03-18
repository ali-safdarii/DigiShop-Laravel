<?php

namespace Database\Seeders;

use App\Utili\Helper;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryAttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        /*
         * | id | name            | unit     | category_id |
|----|-----------------|----------|-------------|
| 1  | Warranty         | Years    | 1           |
| 2  | Dimensions       | Inches   | 1           |
| 3  | Weight           | Pounds   | 1           |
| 4  | Processor        |          | 1           |
| 5  | RAM              |          | 1           |
| 6  | Storage          |          | 1           |
| 7  | GPU              |          | 1           |
| 8  | Display Size     | Inches   | 1           |
| 9  | Display Type     |          | 1           |
| 10 | Display Resolution|          | 1           |
| 11 | Refresh Rate     | Hz       | 1           |*/

       /* $attributesData = [
            [
                'name' => 'Warranty',
                'unit' => 'Years',
                'category_id' => 1 ,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'وزن',
                'unit' => 'کیلوگرم',
                'category_id' => 2 ,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'صفحه نمایش',
                'unit' => 'پیکسل',
                'category_id' => 3 ,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'نوع پارچه',
                'unit' => 'پنبه',
                'category_id' => 2 ,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'نوع مکمل',
                'unit' => 'قرص',
                'category_id' => 1 ,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('category_attributes')->insert($attributesData);*/

        $attributesData = [];


        for ($i = 1; $i <= Helper::$numberOfSeeder; $i++) {
            $attributesData[] = [
                'name' => 'name '.$i,
                'unit' => 'unit' . $i,
                'category_id' => random_int(1,Helper::$numberOfSeeder) ,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('category_attributes')->insert($attributesData);
    }
}
