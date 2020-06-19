<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportQueriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_queries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->longText('message_body');
            $table->string('type');
            $table->string('reported_on_user')->nullable();
            $table->string('reported_on_video')->nullable();
            $table->integer('is_resolved')->default(0);
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
        Schema::dropIfExists('report_queries');
    }
}
