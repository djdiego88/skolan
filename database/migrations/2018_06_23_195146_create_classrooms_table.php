<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassroomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classrooms', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('year_id')->unsigned();
            $table->integer('headquarter_id')->unsigned();
            $table->integer('schoolday_id')->unsigned();
            $table->integer('director_id')->unsigned();
            $table->integer('grade_id')->unsigned();
            $table->string('name');
            $table->integer('quota')->length(5)->nullable();
            $table->foreign('year_id')->references('id')->on('years')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('headquarter_id')->references('id')->on('headquarters')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('schoolday_id')->references('id')->on('schooldays')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('director_id')->references('id')->on('teachers')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('grade_id')->references('id')->on('grades')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
            $table->index('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classrooms');
    }
}
