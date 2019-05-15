<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->date('birth_at');
            $table->string('college')->nullable();
            $table->string('address');
            $table->boolean('available')->default(1);
            $table->integer('schedule_id')->unsigned()->nullable();
            $table->boolean('all_day')->default(1);
            $table->string('specialty');
            //ec: emergency_contact
            $table->string('ec_name')->nullable();
            $table->string('ec_last_name')->nullable();
            $table->string('ec_cellphone')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('schedule_id')->references('id')->on('schedules')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('doctors');
    }
}
