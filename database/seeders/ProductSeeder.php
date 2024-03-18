<?php

namespace Database\Seeders;

use App\Utili\Helper;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productsData = [];

        $loremIpsum = "لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ
         و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه
         و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با
          هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال
         و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را
          برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد.
          در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها
         و شرایط سخت تایپ به پایان رسد وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی
          و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.
";

        $faker = Faker::create();
        for ($i = 1; $i <= Helper::$numberOfSeeder; $i++) {
            $randProductImage = rand(1, 16);
            $randcolorId = rand(1, 40);
            $productsData[] = [
                'name' => 'محصول شماره ' . $i,
                'model_name' => 'Model ' . $i,
                'introduction' => $loremIpsum,
                'slug' => Str::slug('Product ' . $i),
                'image' => json_encode([
                    'indexArray' => [
                        'large' => "admin/images/product/$randProductImage.jpg",
                        'medium' => "admin/images/product/$randProductImage.jpg",
                        'small' => "admin/images/product/$randProductImage.jpg",
                    ],
                    'directory' => "admin/images",
                    'currentImage' => 'medium',
                    'currentImageUrl' => "http://127.0.0.1:8000/admin/images/$randProductImage}.jpg",
                ]),
                'weight' => 1.2 * $i,
                'length' => 15.5 + ($i * 0.5),
                'width' => 10.2 + ($i * 0.5),
                'height' => 8.7 + ($i * 0.5),
                'price' => 100.5 * $i,
                'status' => 1, // 0 => inactive, 1 => active
                'marketable' => 1, // 1 => marketable, 0 => is not marketable
                'sold_number' => 0,
                'frozen_number' => 0,
                'marketable_number' => 0,
                'brand_id' => $i, // Replace with the IDs of the corresponding brands
                'category_id' => $i, // Replace with the IDs of the corresponding product categories
                'default_color_id' => $randcolorId, // Replace with the ID of the default color if needed
                'published_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('products')->insert($productsData);
    }
}
