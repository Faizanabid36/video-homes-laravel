<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVideoSettingsToUserExtras extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_extras', function (Blueprint $table) {
            $table->string('default_video_state')->default('public');
            $table->string('share_buttons')->default('enabled');
            $table->string('display_suggested_videos')->default('enabled');
            $table->string('distribution_type')->default('uploaded');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_extras', function (Blueprint $table) {
            $table->dropColumn('default_video_state');
            $table->dropColumn('share_buttons');
            $table->dropColumn('display_suggested_videos');
            $table->dropColumn('distribution_type');
        });
    }
}
