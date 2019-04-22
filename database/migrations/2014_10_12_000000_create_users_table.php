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
            $table->string('name');
            $table->string('last_name');
            $table->char('dni', 8)->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('cellphone');            
            $table->string('avatar')->default('default.png');
            $table->string('confirmation_code')->nullable();
            $table->boolean('validated')->default(0);
            $table->integer('role');
            $table->string('name_role');
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
