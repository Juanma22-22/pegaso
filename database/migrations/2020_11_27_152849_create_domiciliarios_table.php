<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDomiciliariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('domiciliarios', function (Blueprint $table) {
            $table->id('cedulaDomiciliario');
            $table->string('nombreDomiciliario');
            $table->string('apellidoDomiciliario');
            $table->string('telefonoDomiciliario');
            $table->string('genderDomiciliario');
            $table->string('emailDomiciliario')->unique();
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
        Schema::dropIfExists('domiciliarios');
    }
}
