<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCompanyNameToUserExtras extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `bio` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `phone2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `company_logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `license` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `website_link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
     */

    public function up()
    {
        Schema::table('user_extras', function (Blueprint $table) {
            //
            $table->string('direct_phone')->nullable();
            $table->string('company_name')->nullable();
            $table->string('address')->default('USA');
            $table->string('office_phone')->nullable();
            $table->string('website')->nullable();
            $table->string('license_no')->nullable();
            $table->text('bio')->nullable();
            $table->string('profile_picture')->nullable();
            $table->string('company_logo')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('youtube')->nullable();
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
            $table->dropColumn('company_name');
        });
    }
}
