<?php

namespace Database\Seeders;

use App\Utili\Helper;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productsData = [];

        for ($i = 1; $i <= Helper::$numberOfSeeder; $i++) {
            $numberOfImages = rand(1, 10); // Generate a random number of images for each product

            for ($j = 1; $j <= $numberOfImages; $j++) {
                $randProductImage = rand(1, 16);
                $productsData[] = [
                    'image' => json_encode([
                        'indexArray' => [
                            'large' => "admin/images/product/$randProductImage.jpg",
                            'medium' => "admin/images/product/$randProductImage.jpg",
                            'small' => "admin/images/product/$randProductImage.jpg",
                        ],
                        'directory' => "admin/images",
                        'currentImage' => 'medium',
                        'currentImageUrl' => "http://127.0.0.1:8000/admin/images/$randProductImage.jpg",
                    ]),
                    'product_id' => $i,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        DB::table('product_images')->insert($productsData);
    }
}
