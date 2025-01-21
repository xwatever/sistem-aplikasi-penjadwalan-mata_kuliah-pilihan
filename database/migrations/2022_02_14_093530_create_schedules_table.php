<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('class_id')->unsigned();
            $table->bigInteger('room_id')->unsigned();
            $table->string('title');
            $table->dateTime('start');
            $table->dateTime('end');
            $table->timestamps();

            $table->foreign('class_id')->nullable()->references('id')->on('classrooms')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('room_id')->nullable()->references('id')->on('rooms')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedules');
    }
}
