<?php

namespace Database\Seeders;

use App\Models\Admin\Market\Brand;
use App\Utili\Helper;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       /* $brandsData = [
            [
                'name' => 'Apple',
                'persian_name' => 'اپل',
                'description' => 'Description of Brand 1',
                'slug' => 'brand-1',
                'image' => 'url/to/image1.jpg',
                'status' => 1,
            ],
            [
                'name' => 'Samsung ',
                'persian_name' => 'سامسونگ',
                'description' => 'Description of Brand 2',
                'slug' => 'brand-2',
                'image' => 'url/to/image2.jpg',
                'status' => 1,
            ],

            [
                'name' => 'LG',
                'persian_name' => 'ال جی',
                'description' => 'Description of Brand 3',
                'slug' => 'brand-3',
                'image' => 'url/to/image2.jpg',
                'status' => 1,
            ],


            [
                'name' => 'HP',
                'persian_name' => 'اچ پی',
                'description' => 'Description of Brand 4',
                'slug' => 'brand-4',
                'image' => 'url/to/image2.jpg',
                'status' => 1,
            ],

            [
                'name' => 'Golrang',
                'persian_name' => 'گلرنگ',
                'description' => 'Description of Brand 5',
                'slug' => 'brand-5',
                'image' => 'url/to/image2.jpg',
                'status' => 1,
            ],

            // Add more brands if needed
        ];

        Brand::insert($brandsData);*/


        $brandsData = [];

        for ($i = 1; $i <= Helper::$numberOfSeeder; $i++) {
            $brandsData[] = [
                'name' => 'Brand ' .$i,
                'persian_name' => 'PersianName' .$i ,
                'description' => 'Description of Brand ' .$i,
                'slug' => Str::slug('Brand ' . $i),
                'image' => 'url/to/image2.jpg' .$i ,
                'status' => random_int(0,1),
            ];
        }

        DB::table('brands')->insert($brandsData);


    }
}
