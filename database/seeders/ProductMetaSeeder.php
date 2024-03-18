<?php

namespace Database\Seeders;

use App\Utili\Helper;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ProductMetaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $productId = rand(1, 200);
        $metaData = [
            [
                'id' => 1,
                'meta_key' => 'سایر قابلیت‌ها',
                'meta_value' => 'رابط کاربری One UI Core ۵',
                'product_id' => $productId,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 2,
                'meta_key' => 'ویژگی‌های کلیدی',
                'meta_value' => 'دوربین اصلی قدرتمند',
                'product_id' => $productId,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'id' => 3,
                'meta_key' => 'تراکم پیکسلی',
                'meta_value' => '۴۰۰ پیکسل بر اینچ',
                'product_id' => $productId,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'id' => 4,
                'meta_key' => 'تعداد سیم کارت',
                'meta_value' => '2 عدد',
                'product_id' => $productId,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'id' => 5,
                'meta_key' => 'نسبت صفحه‌نمایش به بدنه',
                'meta_value' => '۸۰.۴',
                'product_id' => $productId,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'id' => 6,
                'meta_key' => 'مدل پردازنده',
                'meta_value' => 'M1',
                'product_id' => $productId,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],


            [
                'id' => 7,
                'meta_key' => 'فناوری صفحه‌نمایش',
                'meta_value' => 'IPS',
                'product_id' => $productId,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'id' => 8,
                'meta_key' => 'اندازه',
                'meta_value' => '6.6',
                'product_id' => $productId,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'id' => 9,
                'meta_key' => 'رزولیشن',
                'meta_value' => '50 مگاپیکسل',
                'product_id' => $productId,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'id' => 10,
                'meta_key' => 'نسخه سیستم عامل',
                'meta_value' => 'اندروید',
                'product_id' => $productId,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];


        foreach ($metaData as $data) {
            DB::table('product_meta')->insert($data);
        }

        /*  $productMetaData = [];

          for ($i = 1; $i <= Helper::$numberOfSeeder; $i++) {
              $productMetaData[] = [
                  'product_id' => $i, // Replace with the IDs of the corresponding products
                  'meta_key' => 'Meta_key ' . $i, // Replace with the IDs of the corresponding category attributes
                  'meta_value' => 'Meta_value ' . $i,
              ];
          }

          DB::table('product_meta')->insert($productMetaData);*/

    }
}
