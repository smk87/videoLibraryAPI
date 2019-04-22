<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->Increments('id')->unique();
            $table->string('url');
            $table->string('description');
            $table->string('thumbnailUrl');
            $table->unsignedInteger('like_id'); // Likes on a video
            $table->unsignedInteger('comment_id'); // Comments on a video
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('videos');
    }
}