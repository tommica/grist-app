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
        Schema::create('plants', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');

            $table->string('scientific_name')->nullable();
            $table->string('botanic_family')->nullable();
            $table->string('cultivar')->nullable();
            $table->integer('plant_spacing')->nullable();
            $table->integer('row_spacing')->nullable();
            $table->integer('sowing_depth')->nullable();
            $table->integer('germination_days')->nullable();
            $table->integer('days_to_maturity')->nullable();
            $table->integer('height')->nullable();
            $table->integer('diameter')->nullable();
            $table->boolean('is_root')->default(0);

            $table->integer('temperature')->nullable();
            $table->text('note')->nullable();
            $table->string('light_requirement')->nullable();
            $table->string('soil_condition')->nullable();
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
        Schema::dropIfExists('plants');
    }
};
