<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDservicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dservices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_id')->unsigned();
            $table->integer('service_id')->unsigned();
            $table->integer('partner_id')->unsigned();
            $table->string('address_from');
            $table->string('address_to');
            $table->date('request_d');
            $table->time('request_t');
            $table->date('delivery_d');
            $table->time('delivery_t');
            $table->timestamps();            
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->foreign('partner_id')->references('id')->on('partners')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('dservices');
    }
}
