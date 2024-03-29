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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->text('body');
            $table->foreignId('parent_id')->constrained('comments');
            $table->foreignId('user_id')->constrained('users');
            $table->unsignedBigInteger('commentable_id');
            $table->string('commentable_type');

            $table->tinyInteger('seen')->default('0')->comment('0 => unseen , 1 => seen');
            $table->tinyInteger('approved')->default('0')->comment('0 => not approved , 1 => approved');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
