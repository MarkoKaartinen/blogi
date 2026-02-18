<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('recipes', function (Blueprint $table) {
            $table->dropColumn(['prep_time', 'cook_time', 'servings']);
            $table->unsignedSmallInteger('servings_amount')->nullable()->after('ingredients');
            $table->string('servings_unit')->nullable()->after('servings_amount');
        });
    }

    public function down(): void
    {
        Schema::table('recipes', function (Blueprint $table) {
            $table->dropColumn(['servings_amount', 'servings_unit']);
            $table->unsignedSmallInteger('prep_time')->nullable();
            $table->unsignedSmallInteger('cook_time')->nullable();
            $table->string('servings')->nullable();
        });
    }
};
