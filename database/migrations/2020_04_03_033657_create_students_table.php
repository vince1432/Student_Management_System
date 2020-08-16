<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('student_id')->unique();
			$table->string('first_name');
            $table->string('last_name');
            $table->date('birthday');
            $table->string('gender');
            $table->string('building');
            $table->string('barangay');
            $table->string('city');
            $table->string('province');
            $table->string('contact_number');
            $table->integer('course_id');
			$table->string('email')->unique();
			$table->timestamp('email_verified_at')->nullable();
			$table->timestamps();
			$table->softDeletes();

			$table->index('course_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
