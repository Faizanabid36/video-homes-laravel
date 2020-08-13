<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->string('display_title')->nullable();
            $table->string('button_1')->nullable();
            $table->string('button_1_link')->nullable();
            $table->string('button_2')->nullable();
            $table->string('button_2_link')->nullable();
            $table->text('box_1')->nullable();
            $table->text('box_2')->nullable();
            $table->text('box_3')->nullable();
            $table->text('box_4')->nullable();
            $table->string('parallax_video')->nullable();
            $table->string('call_to_action_title')->nullable();
            $table->string('call_to_action')->nullable();
            $table->string('call_to_action_link')->nullable();
            $table->text('footer')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
