<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->string('image')->nullable();
            $table->string('date');
            $table->string('internalLink')->nullable();
            $table->string('externalLink')->nullable();
            $table->string('webLink')->nullable();
            $table->string('appLink')->nullable();
            $table->boolean('android');
            $table->boolean('ios');
            $table->boolean('chrome');
            $table->boolean('chromeweb');
            $table->boolean('firefox');
            $table->boolean('safari');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}
