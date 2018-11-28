<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHomeworksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('homeworks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('classroom_subject_id')->unsigned();
            $table->string('name');
            $table->longText('description');
            $table->date('deadline');
            $table->foreign('classroom_subject_id')->references('id')->on('classroom_subject')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
            $table->index('deadline');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('homeworks');
    }
}
