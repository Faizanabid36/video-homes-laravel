<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToVideos extends Migration
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
            $table->string('original_name');
            $table->string('disk');
            $table->string('stream_path')->nullable();
            $table->boolean('processed')->default(false);
            $table->datetime('converted_for_streaming_at')->nullable();
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
            $table->dropColumn('original_name');
            $table->dropColumn('disk');
            $table->dropColumn('stream_path');
            $table->dropColumn('processed');
            $table->dropColumn('converted_for_streaming_at');
        });
    }
}
