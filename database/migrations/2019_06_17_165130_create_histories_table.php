<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('histories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('attention_id')->unsigned();
            $table->string('cardiac_frequency')->nullable();
            $table->string('breathing_frequency')->nullable();
            $table->string('temperature')->nullable();
            $table->string('arterial_pressure')->nullable();
            $table->string('personal_antecedents')->nullable();
            $table->string('family_antecedents')->nullable();
            $table->integer('pdf_status')->default(0);
            /* 0:inactive   1:requested  2:active */
            $table->foreign('attention_id')->references('id')->on('attentions')->onDelete('cascade');
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
        Schema::drop('histories');
    }
}
