<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsPlayedToVideoViews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('video_views', function (Blueprint $table) {
            //
            $table->smallInteger('is_played')->default('0');
            $table->integer('video_user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('video_views', function (Blueprint $table) {
            //
            $table->dropColumn('is_played');
            $table->dropColumn('video_user');
        });
    }
}
