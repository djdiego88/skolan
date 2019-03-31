<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAbsencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absences', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('schoolterm_id');
            $table->unsignedBigInteger('classroom_subject_id');
            $table->unsignedBigInteger('student_id');
            $table->date('date');
            $table->integer('number')->length(3)->default(1);
            $table->foreign('schoolterm_id')->references('id')->on('schoolterms')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('classroom_subject_id')->references('id')->on('classroom_subject')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('students')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
            $table->index('date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('absences');
    }
}
