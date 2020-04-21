<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('title');
            $table->string('video_id');
            $table->text('description')->nullable();
            $table->string('video_motion');
            $table->integer('is_proof_video')->nullable();
            $table->text('tags')->nullable();
            $table->string('video_custom_id')->nullable();
            $table->string('external_link_url')->nullable();
            $table->string('external_link_name')->nullable();
            $table->string('video_type');
            $table->integer('user_id');
            $table->double('duration', 11, 2);
            $table->bigInteger('size');
            $table->text('video_path');
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
