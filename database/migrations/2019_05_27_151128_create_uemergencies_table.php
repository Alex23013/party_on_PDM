<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUemergenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uemergencies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('p_name');
            $table->string('p_last_name');
            $table->char('p_dni',8);
            $table->string('p_cell');
            $table->text('motive');
            $table->string('address')->nullable();
            $table->string('reference')->nullable();
            $table->string('att_latitude')->nullable();
            $table->string('att_longitude')->nullable();
            $table->string('caller_name')->nullable();
            $table->string('caller_last_name')->nullable();
            $table->char('caller_dni',8)->nullable();
            $table->string('caller_cell')->nullable();
            //other_contact
            $table->string('oc_name')->nullable();
            $table->string('oc_cell')->nullable();
            $table->string('oc_relationship')->nullable();
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
        Schema::drop('uemergencies');
    }
}
