<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGeolocationToUserExtras extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_extras', function (Blueprint $table) {
            //
            $table->string('location_latitude')->nullable();
            $table->string('location_longitude')->nullable();
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
            //
            $table->dropColumn('location_longitude');
            $table->dropColumn('location_latitude');
        });
    }
}
