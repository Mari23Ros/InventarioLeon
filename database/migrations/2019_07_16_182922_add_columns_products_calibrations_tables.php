<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsProductsCalibrationsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('calibrations', function (Blueprint $table) {
            $table->string('commentary')->nullable()->after('details');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->string('name')->after('id');
            $table->string('code')->unique()->after('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('calibrations', function (Blueprint $table) {
            $table->dropColumn('commentary');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('code');
        });
    }
}
