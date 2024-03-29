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
        Schema::create('audio', function (Blueprint $table) {
            $table->id();
            $table->foreignId('playlist_id');
            $table->string('image');
            $table->string('title');
            $table->string('description')->nullable();
            $table->string('program')->nullable();
            $table->string('event')->nullable();
            $table->string('artist')->nullable();
            $table->string('date')->nullable();
            $table->string('url');
            $table->boolean('featured');
            $table->string('notificationTitle');
            $table->string('notificationContent');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audio');
    }
};
