<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnrollmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enrollments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('classroom_id')->unsigned();
            $table->integer('student_id')->unsigned();
            $table->foreign('classroom_id')->references('id')->on('classrooms')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('students')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('preenrollments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('grade_id')->unsigned();
            $table->integer('student_id')->unsigned();
            $table->integer('year_id')->unsigned();
            $table->string('type',30);
            $table->foreign('grade_id')->references('id')->on('grades')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('students')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('year_id')->references('id')->on('years')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('preenrollments');
        Schema::dropIfExists('enrollments');
    }
}
