<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuardiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guardians', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('occupation')->nullable();
            $table->string('marital_status', 60)->nullable();
            $table->string('studies')->nullable();
            $table->string('neighborhood')->nullable();
            $table->integer('socioeconomic_level')->nullable();
            $table->string('commune')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('guardian_student', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('guardian_id')->unsigned();
            $table->integer('student_id')->unsigned();
            $table->string('relation',60);
            $table->foreign('guardian_id')->references('id')->on('guardians')->onUpdate('cascade')->onDelete('cascade');
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
