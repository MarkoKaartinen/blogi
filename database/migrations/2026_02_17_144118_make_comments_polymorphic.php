<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->string('commentable_type')->nullable()->after('article_id');
            $table->unsignedBigInteger('commentable_id')->nullable()->after('commentable_type');
            $table->index(['commentable_type', 'commentable_id']);
        });

        // Migrate existing article comments
        DB::table('comments')->whereNotNull('article_id')->update([
            'commentable_type' => 'App\Models\Article',
            'commentable_id' => DB::raw('article_id'),
        ]);

        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign(['article_id']);
            $table->dropColumn('article_id');

            $table->string('commentable_type')->nullable(false)->change();
            $table->unsignedBigInteger('commentable_id')->nullable(false)->change();
        });
    }

    public function down(): void
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->foreignId('article_id')->nullable()->constrained('articles');
        });

        DB::table('comments')->where('commentable_type', 'App\Models\Article')->update([
            'article_id' => DB::raw('commentable_id'),
        ]);

        Schema::table('comments', function (Blueprint $table) {
            $table->dropIndex(['commentable_type', 'commentable_id']);
            $table->dropColumn(['commentable_type', 'commentable_id']);
        });
    }
};
