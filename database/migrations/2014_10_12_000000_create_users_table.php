<?php

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
            $table->increments('id');            
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->string('phone', 20)->nullable();
            $table->date('birthday')->nullable()->comment('Data de nascimento');
            $table->enum('gender', ['M', 'F'])->nullable();            
            $table->string('cpf', 14)->nullable();               
            $table->unsignedInteger('role_id');
            $table->foreign('role_id')->references('id')->on('role');
            $table->enum('active', ['Y', 'N'])->default('Y');
            $table->rememberToken();
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
        Schema::drop('users');
    }
}
