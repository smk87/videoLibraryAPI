<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('videos', function (Blueprint $table) {
            $table->string('title', 250)->change();
            $table->string('url', 250)->change();
            $table->string('description', 2000)->nullable()->change();
            $table->string('thumbnailUrl', 250)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('videos', function (Blueprint $table) {
            $table->string('title')->change();
            $table->string('url')->change();
            $table->string('description')->change();
            $table->string('thumbnailUrl')->change();
        });
    }
}