<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AttentionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attentions', function (Blueprint $table) {
            $table->increments('id');
            $table->char('attention_code', 6)->unique();
            $table->integer('user_id')->unsigned();
            $table->text('motive');
            $table->string('address')->nullable();
            $table->string('reference')->nullable();
            $table->string('att_latitude')->nullable();
            $table->string('att_longitude')->nullable();
            $table->integer('type');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('attentions');
    }
}
