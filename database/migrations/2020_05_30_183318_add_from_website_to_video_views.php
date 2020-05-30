<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFromWebsiteToVideoViews extends Migration
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
            $table->smallInteger('from_website')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('website_to_video_views', function (Blueprint $table) {
            //
            $table->dropColumn('from_website');
        });
    }
}
