<?php

namespace Database\Seeders;

use App\Models\Admin\Content\Banner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $banners = [
            [
                'title' => 'Banner Title 1',
                'image' => "\"admin/images/slideshow/1.jpg\"",
                'description' => 'Banner Description 1',
                'position' => 1,
                'url' => 'https://example.com',
                'status' => 1,
                'is_used_mobile' => 0,
            ],
            [
                'title' => 'Banner Title 2',
                'image' => "\"admin/images/slideshow/2.jpg\"",
                'description' => 'Banner Description 2',
                'position' => 1,
                'url' => 'https://example.com',
                'status' => 1,
                'is_used_mobile' => 0,
            ],

            [
                'title' => 'Banner Title 3',
                'image' => "\"admin/images/slideshow/3.jpg\"",
                'description' => 'Banner Description 3',
                'position' => 1,
                'url' => 'https://example.com',
                'status' => 1,
                'is_used_mobile' => 0,
            ],

            [
                'title' => 'Banner Title 4',
                'image' => "\"admin/images/slideshow/4.jpg\"",
                'description' => 'Banner Description 4',
                'position' => 1,
                'url' => 'https://example.com',
                'status' => 1,
                'is_used_mobile' => 0,
            ],

            [
                'title' => 'Banner Title 5',
                'image' => "\"admin/images/slideshow/5.jpg\"",
                'description' => 'Banner Description 5',
                'position' => 1,
                'url' => 'https://example.com',
                'status' => 1,
                'is_used_mobile' => 0,
            ],

            [
                'title' => 'Banner Title 6',
                'image' => "\"admin/images/slideshow/12.gif\"",
                'description' => 'Banner Description 6',
                'position' => 2,
                'url' => 'https://example.com',
                'status' => 1,
                'is_used_mobile' => 0,
            ],


            [
                'title' => 'Banner Title 7',
                'image' => "\"admin/images/slideshow/11.jpg\"",
                'description' => 'Banner Description 7',
                'position' => 2,
                'url' => 'https://example.com',
                'status' => 1,
                'is_used_mobile' => 0,
            ],

            [
                'title' => 'Banner Title 8',
                'image' => "\"admin/images/ads/two-col-1.jpg\"",
                'description' => 'Banner Description 8',
                'position' => 4,
                'url' => 'https://example.com',
                'status' => 1,
                'is_used_mobile' => 0,
            ],

            [
                'title' => 'Banner Title 9',
                'image' => "\"admin/images/ads/two-col-2.jpg\"",
                'description' => 'Banner Description 9',
                'position' => 4,
                'url' => 'https://example.com',
                'status' => 1,
                'is_used_mobile' => 0,
            ],


            [
                'title' => 'Banner Title 10',
                'image' => "\"admin/images/ads/one-col-1.jpg\"",
                'description' => 'Banner Description 10',
                'position' => 7,
                'url' => 'https://example.com',
                'status' => 1,
                'is_used_mobile' => 0,
            ],

        ];

        foreach ($banners as $bannerData) {
            DB::table('banners')->insert(array_merge(
                $bannerData,
                ['created_at' => now(), 'updated_at' => now()]
            ));
        }
    }
}

