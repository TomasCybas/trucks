<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('client_id');
            //TODO container types to be added
            $table->enum('container_type', ['Tipas A', 'Tipas B']);
            $table->string('container_no', 11);
            $table->unsignedBigInteger('loading_city_id');
            $table->unsignedBigInteger('unloading_city_id');
            $table->enum('type', ['Tiesioginis', 'Atgalinis']);
            $table->date('loading_date');
            $table->unsignedBigInteger('driver_id');
            $table->unsignedBigInteger('truck_id');
            $table->enum('vat', ['Taip', 'Ne']);
            $table->integer('price')->unsigned();
            $table->timestamps();


            // Foreign keys
            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('loading_city_id')->references('id')->on('cities');
            $table->foreign('unloading_city_id')->references('id')->on('cities');
            $table->foreign('driver_id')->references('id')->on('drivers');
            $table->foreign('truck_id')->references('id')->on('trucks');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
