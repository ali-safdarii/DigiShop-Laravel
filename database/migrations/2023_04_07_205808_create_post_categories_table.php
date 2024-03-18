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
        Schema::create('post_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('description');
            $table->string('slug')->unique()->nullable();
            $table->longText('image')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->foreignId('parent_id')->nullable()->constrained('post_categories');
            $table->timestamps();
            $table->softDeletes();
        });

        // pivot table migration for many-to-many relationship
        Schema::create('post_category_tag', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('post_category_id');
            $table->unsignedBigInteger('tag_id');
            $table->timestamps();

            $table->foreign('post_category_id')->references('id')->on('post_categories')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_categories');
    }
};
