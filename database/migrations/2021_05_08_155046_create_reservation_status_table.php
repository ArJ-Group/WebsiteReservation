<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservation_status', function (Blueprint $table) {
            $table->id('reservation_status_id');
            $table->string('reservation_code');
            $table->foreign('reservation_code')->references('reservation_code')->on('reservation')->onDelete('cascade')->onUpdate('cascade');
            $table->boolean('status');
            $table->integer('price');
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
        Schema::dropIfExists('reservation_status');
    }
}
