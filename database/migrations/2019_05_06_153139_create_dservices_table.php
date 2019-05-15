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
            $table->integer('user_id')->unsigned();
            $table->integer('service_id')->unsigned();
            $table->integer('partner_id')->unsigned();
            $table->string('address_from');
            $table->string('address_from_latitude')->nullable(); //address from : partner
            $table->string('address_from_longitude')->nullable();
            $table->string('address_to');
            $table->string('address_to_latitude')->nullable(); //address to :patient
            $table->string('address_to_longitude')->nullable();
            $table->dateTime('delivery')->nullable();
            $table->dateTime('execution')->nullable();
            $table->boolean('complete')->default(0);
            $table->timestamps(); //request = created_at           
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
