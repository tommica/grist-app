<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companion_plants', function (Blueprint $table) {
            $table->id();
            $table->uuid('plant_1_id');
            $table->foreign('plant_1_id')->references('id')->on('plants')->onDelete('cascade');
            $table->uuid('plant_2_id');
            $table->foreign('plant_2_id')->references('id')->on('plants')->onDelete('cascade');
            $table->boolean('is_positive')->default(0);
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
        Schema::dropIfExists('plant_plant');
    }
};
