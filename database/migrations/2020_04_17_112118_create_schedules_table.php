<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
			$table->bigIncrements('id');
			$table->integer('room_id');
			$table->integer('teacher_id');
            $table->string('day');
            $table->time('start_time');
            $table->time('fisnish_time');
			$table->timestamps();

			$table->index('room_id');
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
