<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->integer('year');
            $table->string('slug')->unique();
            $table->string('file');
            $table->json('ingredients')->nullable();
            $table->unsignedSmallInteger('prep_time')->nullable()->comment('Minutes');
            $table->unsignedSmallInteger('cook_time')->nullable()->comment('Minutes');
            $table->string('servings')->nullable();
            $table->string('status')->default('draft');
            $table->boolean('post_to_mastodon')->default(true);
            $table->string('mastodon_post_id')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};
