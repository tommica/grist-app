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
        Schema::create('activity_periods', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('plant_id');
            $table->string('type');
            $table->tinyInteger('start_month');
            $table->string('start_time');
            $table->tinyInteger('end_month');
            $table->string('end_time');
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
        Schema::dropIfExists('activity_periods');
    }
};
