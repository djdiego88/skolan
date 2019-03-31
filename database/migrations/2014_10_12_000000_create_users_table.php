<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('it', 10);
            $table->string('nid', 16)->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->nullable();
            $table->string('password');
            $table->date('birth_date');
            $table->enum('gender', ['m', 'f']);
            $table->string('phone_number');
            $table->string('cellphone_number')->nullable();
            $table->string('nacionality',10);
            $table->string('location');
            $table->string('address');
            $table->string('photo')->nullable();
            $table->string('status',20);
            $table->dateTime('last_access');
            $table->rememberToken();
            $table->timestamps();
            $table->index('email');
            $table->index('first_name');
            $table->index('last_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
