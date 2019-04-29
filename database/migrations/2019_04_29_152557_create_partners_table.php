<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partners', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('sector');
            $table->string('social_reason');
            $table->char('RUC', 11)->unique();
            $table->string('cell1'); 
            $table->string('cell2')->nullable();
            $table->string('address');
            $table->string('hours_of_operation')->nullable(); 
            //# de cuenta corriente
            $table->string('current_acount')->nullable();
            // # de cuenta de la empresa
            $table->string('number_acount')->nullable(); 
            $table->string('web_page')->nullable();
            $table->string('email')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('partners');
    }
}
