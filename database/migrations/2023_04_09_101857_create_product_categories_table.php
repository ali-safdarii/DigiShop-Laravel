<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('slug')->unique()->nullable();
            $table->longText('image')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('show_in_menu')->default(0);
            //$table->string('tags')->nullable();
            $table->foreignId('parent_id')->nullable()->constrained('product_categories');
            $table->softDeletes();
            $table->timestamps();
        });

        // pivot table migration for many-to-many relationship
        Schema::create('product_category_tag', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_category_id');
            $table->unsignedBigInteger('tag_id');
            $table->timestamps();

            $table->foreign('product_category_id')->references('id')->on('product_categories')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_categories');
    }
};
