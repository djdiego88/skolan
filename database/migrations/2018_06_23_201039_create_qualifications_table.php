<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQualificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qualifications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('classroom_subject_id')->unsigned();
            $table->integer('student_id')->unsigned();
            $table->integer('year_id')->unsigned();
            $table->integer('schoolterm_id')->unsigned();
            $table->integer('number')->length(4);
            $table->float('value');
            $table->foreign('classroom_subject_id')->references('id')->on('classroom_subject')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('students')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('year_id')->references('id')->on('years')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('schoolterm_id')->references('id')->on('schoolterms')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('final_qualifications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('classroom_subject_id')->unsigned();
            $table->integer('student_id')->unsigned();
            $table->integer('year_id')->unsigned();
            $table->integer('schoolterm_id')->unsigned();
            $table->float('value');
            $table->foreign('classroom_subject_id')->references('id')->on('classroom_subject')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('students')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('year_id')->references('id')->on('years')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('schoolterm_id')->references('id')->on('schoolterms')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('final_qualifications');
        Schema::dropIfExists('qualifications');
    }
}
