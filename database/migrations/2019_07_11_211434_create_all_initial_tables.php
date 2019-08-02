<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAllInitialTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movement_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',50);
            $table->timestamps();
        });
        Schema::create('document_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',50);
            $table->timestamps();
        });
        Schema::create('warehouses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',50);
            $table->string('location',50);
            $table->boolean('confirmed')->nullable();
            $table->timestamps();
        });

        Schema::create('categories', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string('name', 50);
            $table->timestamps();
        });
        Schema::create('states', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string('name', 50);
            $table->timestamps();
        });
        Schema::create('sizes', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string('name', 50);
            $table->timestamps();
        });
        Schema::create('calibrations', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->date('last');
            $table->date('next')->nullable();
            $table->text('details')->nullable();
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
        Schema::dropIfExists('movement_types');
        Schema::dropIfExists('document_types');
        Schema::dropIfExists('warehouses');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('states');
        Schema::dropIfExists('sizes');
        Schema::dropIfExists('calibrations');
    }
}
