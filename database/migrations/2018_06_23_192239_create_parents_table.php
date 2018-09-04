<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('occupation')->nullable();
            $table->string('civil_status', 30)->nullable();
            $table->string('studies')->nullable();
            $table->string('neighborhood')->nullable();
            $table->integer('socioeconomic_level')->nullable();
            $table->string('commune')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('parent_student', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->unsigned();
            $table->integer('student_id')->unsigned();
            $table->string('relation',30);
            $table->foreign('parent_id')->references('id')->on('parents')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('students')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('parent_student');
        Schema::dropIfExists('parents');
    }
}
