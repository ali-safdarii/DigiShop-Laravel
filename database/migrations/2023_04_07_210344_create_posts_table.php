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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique()->nullable();
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('is_comment')->default(0)->comment('0 => disable user comment , 1 => enable user comment');
            $table->text('body')->comment('post description');
            $table->string('summery')->nullable();
            $table->longText('image')->nullable();
            $table->timestamp('published_at');

            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('category_id')->constrained('post_categories');
            $table->softDeletes();
            $table->timestamps();
        });

        // pivot table migration for many-to-many relationship
        Schema::create('post_tag', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('post_id');
            $table->unsignedBigInteger('tag_id');
            $table->timestamps();

            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
