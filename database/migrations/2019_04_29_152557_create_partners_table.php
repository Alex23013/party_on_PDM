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
            $table->string('partner_name');
            $table->string('sector');
            $table->string('social_reason');
            $table->char('ruc', 11)->unique();
            $table->string('cell_1'); 
            $table->string('cell_2')->nullable();
            $table->string('address');
            $table->string('hours_of_operation')->nullable(); 
            //# de cuenta corriente
            $table->string('current_acount')->nullable();
            // # de cuenta de la empresa
            $table->string('number_acount')->nullable(); 
            $table->string('web_page')->nullable();
            $table->string('email')->nullable();
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
        Schema::drop('partners');
    }
}
