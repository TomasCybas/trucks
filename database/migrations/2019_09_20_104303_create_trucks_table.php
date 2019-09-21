<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrucksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trucks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('brand', 25);
            $table->string('model', 25);
            $table->string('reg_number', 10);
            //TODO  driver_id to be decided
            //$table->unsignedBigInteger('driver_id');
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
        Schema::dropIfExists('trucks');
    }
}
