<?php

namespace Database\Seeders;

use App\Utili\Helper;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        $categories = [
            [
                'id' => 1,
                'name' => 'کالای دیجیتال',
                'description' => '',
                'slug' => 'kalaye_digital',
                'image' => json_encode([
                    'indexArray' => [
                        'large' => "admin/images/category/kalaye_digital.jpg",
                        'medium' => "admin/images/category/kalaye_digital.jpg",
                        'small' => "admin/images/category/kalaye_digital.jpg",
                    ],
                    'directory' => "admin/images",
                    'currentImage' => 'medium',
                    'currentImageUrl' => "http://127.0.0.1:8000/admin/images/category/kalaye_digital.jpg",
                ]),
                'status' => 1, // 0 => inactive, 1 => active
                'show_in_menu' => 1, // 0 => hide, 1 => show
                'parent_id' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'id' => 2,
                'name' => 'لوازم پزشکی',
                'description' => '',
                'slug' => 'lavazem_pezeshki',
                'image' => json_encode([
                    'indexArray' => [
                        'large' => "admin/images/category/lavazem_pezeshki.jpg",
                        'medium' => "admin/images/category/lavazem_pezeshki.jpg",
                        'small' => "admin/images/category/lavazem_pezeshki.jpg",
                    ],
                    'directory' => "admin/images",
                    'currentImage' => 'medium',
                    'currentImageUrl' => "http://127.0.0.1:8000/admin/images/category/lavazem_pezeshki.jpg",
                ]),
                'status' => 1, // 0 => inactive, 1 => active
                'show_in_menu' => 1, // 0 => hide, 1 => show
                'parent_id' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'id' => 3,
                'name' => 'کتاب',
                'description' => '',
                'slug' => 'ketab',
                'image' => json_encode([
                    'indexArray' => [
                        'large' => "admin/images/category/ketab.jpg",
                        'medium' => "admin/images/category/ketab.jpg",
                        'small' => "admin/images/category/ketab.jpg",
                    ],
                    'directory' => "admin/images",
                    'currentImage' => 'medium',
                    'currentImageUrl' => "http://127.0.0.1:8000/admin/images/category/ketab.jpg",
                ]),
                'status' => 1, // 0 => inactive, 1 => active
                'show_in_menu' => 1, // 0 => hide, 1 => show
                'parent_id' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'id' => 4,
                'name' => 'لوازم خانگی',
                'description' => '',
                'slug' => 'lavazem_khanegi',
                'image' => json_encode([
                    'indexArray' => [
                        'large' => "admin/images/category/lavazem_khanegi.jpg",
                        'medium' => "admin/images/category/lavazem_khanegi.jpg",
                        'small' => "admin/images/category/lavazem_khanegi.jpg",
                    ],
                    'directory' => "admin/images",
                    'currentImage' => 'medium',
                    'currentImageUrl' => "http://127.0.0.1:8000/admin/images/category/lavazem_khanegi.jpg",
                ]),
                'status' => 1, // 0 => inactive, 1 => active
                'show_in_menu' => 1, // 0 => hide, 1 => show
                'parent_id' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'id' => 5,
                'name' => 'مد و پوشاک',
                'description' => '',
                'slug' => 'mod_poshak',
                'image' => json_encode([
                    'indexArray' => [
                        'large' => "admin/images/category/mod_poshak.jpg",
                        'medium' => "admin/images/category/mod_poshak.jpg",
                        'small' => "admin/images/category/mod_poshak.jpg",
                    ],
                    'directory' => "admin/images",
                    'currentImage' => 'medium',
                    'currentImageUrl' => "http://127.0.0.1:8000/admin/images/category/mod_poshak.jpg",
                ]),
                'status' => 1, // 0 => inactive, 1 => active
                'show_in_menu' => 1, // 0 => hide, 1 => show
                'parent_id' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'id' => 6,
                'name' => 'کالای ورزشی',
                'description' => '',
                'slug' => 'kalaye_varzeshi',
                'image' => json_encode([
                    'indexArray' => [
                        'large' => "admin/images/category/varzeshi.jpg",
                        'medium' => "admin/images/category/varzeshi.jpg",
                        'small' => "admin/images/category/varzeshi.jpg",
                    ],
                    'directory' => "admin/images",
                    'currentImage' => 'medium',
                    'currentImageUrl' => "http://127.0.0.1:8000/admin/images/category/varzeshi.jpg",
                ]),
                'status' => 1, // 0 => inactive, 1 => active
                'show_in_menu' => 1, // 0 => hide, 1 => show
                'parent_id' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

         /*   [
                'id' => 7,
                'name' => 'زیبایی و سلامت',
                'description' => '',
                'slug' => 'zibaii_salamat',
                'image' => json_encode([
                    'indexArray' => [
                        'large' => "admin/images/category/zibaii_salamat.jpg",
                        'medium' => "admin/images/category/zibaii_salamat.jpg",
                        'small' => "admin/images/category/zibaii_salamat.jpg",
                    ],
                    'directory' => "admin/images",
                    'currentImage' => 'medium',
                    'currentImageUrl' => "http://127.0.0.1:8000/admin/images/category/zibaii_salamat.jpg",
                ]),
                'status' => 1, // 0 => inactive, 1 => active
                'show_in_menu' => 1, // 0 => hide, 1 => show
                'parent_id' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],*/
        ];
        DB::table('product_categories')->insert($categories);

       /* $categoriesData = [];
        for ($i = 1; $i <= Helper::$numberOfSeeder; $i++) {
            $categoriesData[] = [
                'name' => 'Category ' . $i,
                'description' => 'Description of Category ' . $i,
                'slug' => Str::slug('Category ' . $i),
                'image' => json_encode([
                    'indexArray' => [
                        'large' => "admin/images/not_found_large.png",
                        'medium' => "admin/images/not_found_medium.png",
                        'small' => "admin/images/not_found_small.png",
                    ],
                    'directory' => "admin/images",
                    'currentImage' => 'medium',
                    'currentImageUrl' => "http://127.0.0.1:8000/admin/images/not_found.png",
                ]),
                'status' => 1, // 0 => inactive, 1 => active
                'show_in_menu' => 1, // 0 => hide, 1 => show
                'parent_id' => null, // Replace with the parent category ID if needed
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('product_categories')->insert($categoriesData);*/

    }


}
