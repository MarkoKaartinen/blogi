<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('guestbook_messages', function (Blueprint $table) {
            $table->id();
            $table->string('nickname');
            $table->string('homepage')->nullable()->default(null);
            $table->text('message');
            $table->text('reply')->nullable()->default(null);
            $table->timestamp('replied_at')->nullable()->default(null);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('guestbook_messages');
    }
};
