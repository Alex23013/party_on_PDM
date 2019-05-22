<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EmergenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emergencies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('attention_id')->unsigned();
            $table->string('caller_name');
            $table->char('caller_dni',8);
            $table->string('caller_cell');
            //other_contact
            $table->string('oc_name')->nullable();
            $table->string('oc_cell')->nullable();
            $table->string('oc_relationship')->nullable();
            $table->timestamps();
            $table->foreign('attention_id')->references('id')->on('attentions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('emergencies');
    }
}
