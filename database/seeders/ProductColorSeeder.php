<?php

namespace Database\Seeders;

use App\Utili\Helper;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productColorData = [];

        for ($i = 1; $i <= Helper::$numberOfSeeder; $i++) {
            $numberOfColors = rand(1, 5);

            for ($j = 1; $j <= $numberOfColors; $j++) {
                $colorId = rand(1, 10);

                $productColorData[] = [
                    'product_id' => $i,
                    'color_id' => $colorId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        DB::table('product_colors')->insertOrIgnore($productColorData);
    }
}
