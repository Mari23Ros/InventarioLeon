<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('workers', function (Blueprint $table){
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('last_name', 50)->nullable();
            $table->integer('dni')->unsigned()->nullable();
            $table->string('phone', 50)->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('movements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('movement_type_id');
            $table->foreign('movement_type_id')->references('id')->on('movement_types')->onDelete('cascade');
            $table->unsignedBigInteger('document_type_id');
            $table->foreign('document_type_id')->references('id')->on('document_types')->onDelete('cascade');
            $table->string('document_number', 50);
            $table->date('date');
            $table->unsignedBigInteger('buyer')->nullable();
            $table->foreign('buyer')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('authorizer')->nullable();
            $table->foreign('authorizer')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('deliverer')->nullable();
            $table->foreign('deliverer')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('reciever')->nullable();
            $table->foreign('reciever')->references('id')->on('users')->onDelete('cascade');
            $table->text('courier_description')->nullable();
            $table->unsignedBigInteger('origin')->nullable();
            $table->foreign('origin')->references('id')->on('warehouses')->onDelete('cascade');
            $table->unsignedBigInteger('destination')->nullable();
            $table->foreign('destination')->references('id')->on('warehouses')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('products', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->text('description')->nullable();
            $table->string('brand', 50)->nullable();
            $table->string('serie', 100)->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->unsignedBigInteger('state_id')->nullable();
            $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade');
            $table->unsignedBigInteger('size_id')->nullable();
            $table->foreign('size_id')->references('id')->on('sizes')->onDelete('cascade');
            $table->unsignedBigInteger('calibration_id')->nullable();
            $table->foreign('calibration_id')->references('id')->on('calibrations')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('movement_product', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->unsignedBigInteger('movement_id')->nullable();
            $table->foreign('movement_id')->references('id')->on('movements')->onDelete('cascade');
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->integer('quantity')->unsigned()->nullable();
            $table->boolean('confirmed')->nullable();
        });
        Schema::create('product_warehouse', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->unsignedBigInteger('warehouse_id')->nullable();
            $table->foreign('warehouse_id')->references('id')->on('warehouses')->onDelete('cascade');
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->integer('stock')->unsigned()->nullable();
            $table->boolean('confirmed')->nullable();
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

        Schema::dropIfExists('movements');
        Schema::dropIfExists('products');
        Schema::dropIfExists('movement_product');
        Schema::dropIfExists('product_warehouse');
    }
}
