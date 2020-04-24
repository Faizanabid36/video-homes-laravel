<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoreFieldsToVideos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('videos', function (Blueprint $table) {
            //
            $table->string('width')->nullable();
            $table->boolean('360p')->nullable();
            $table->boolean('480p')->nullable();
            $table->boolean('720p')->nullable();
            $table->boolean('1080p')->nullable();
            $table->boolean('1440p')->nullable();
            $table->boolean('4K')->nullable();
            $table->boolean('8k')->nullable();
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
            //
            $table->dropColumn('width');
            $table->dropColumn('360p');
            $table->dropColumn('480p');
            $table->dropColumn('720p');
            $table->dropColumn('1080p');
            $table->dropColumn('2048p');
            $table->dropColumn('4096p');
        });
    }
}
