<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->string('nickname');
            $table->string('email');
            $table->text('comment');
            $table->string('link')->nullable()->default(null);
            $table->foreignId('article_id')->constrained('articles');
            $table->foreignId('parent_id')->nullable()->default(null)->constrained('comments');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
