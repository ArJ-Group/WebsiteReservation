<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service', function (Blueprint $table) {
            $table->id('service_id');
            $table->unsignedBigInteger('category_service_id');
            $table->foreign('category_service_id')->references('category_service_id')->on('category_service')->onDelete('cascade')->onUpdate('cascade');
            $table->string('name');
            $table->integer('price');
            $table->string('image')->default('images/serviceDefault.jpg');
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
        Schema::dropIfExists('service');
    }
}
