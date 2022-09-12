<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('ingredients', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('recipe_id');
            $table->string('ingredient');
            $table->float('amount');
            $table->string('unit_of_measurement');

            $table->foreign('recipe_id')->references('id')->on('recipes')
            ->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ingredients');
    }
};
