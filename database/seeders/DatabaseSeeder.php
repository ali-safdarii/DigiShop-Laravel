<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Admin\Content\Banner;
use App\Models\Admin\Content\Comment;
use App\Models\Admin\Content\Post;
use App\Models\Admin\Content\PostCategory;
use App\Models\Admin\Market\Brand;
use App\Models\Admin\Market\CategoryAttribute;
use App\Models\Admin\Market\CategoryValue;
use App\Models\Admin\Market\Color;
use App\Models\Admin\Market\Delivery;
use App\Models\Admin\Market\Discount;
use App\Models\Admin\Market\Product;
use App\Models\Admin\Market\ProductCategory;
use App\Models\Admin\Payment\Payment;
use App\Models\Tag;
use App\Models\User;
use App\Utili\Helper;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // Call the Seeders
        $this->call([
            ProductSeeder::class,
            BrandSeeder::class,
            ProductCategorySeeder::class,
            CategoryAttributeSeeder::class,
            CategoryValueSeeder::class,
            PermissonRoleSeeder::class,
            ProductColorSeeder::class,
            ProductMetaSeeder::class,
            BannerSeeder::class,
            ProductImageSeeder::class
            // Add more seeders if needed
        ]);

        // Create and Seed the Factories
        User::factory(Helper::$numberOfSeeder)->create();
        Tag::factory(Helper::$numberOfSeeder)->create();
        PostCategory::factory(Helper::$numberOfSeeder)->create();
        Delivery::factory(Helper::$numberOfSeeder)->create();
        Post::factory(Helper::$numberOfSeeder)->create();
        Comment::factory(Helper::$numberOfSeeder)->create();
        Color::factory(Helper::$numberOfSeeder)->create();
        Payment::factory(Helper::$numberOfSeeder)->create();
        Discount::factory(Helper::$numberOfSeeder)->create();
      //  Banner::factory(40)->create();
        // User\Role::factory(10)->create(); // Uncomment if needed


    }
}
