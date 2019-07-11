<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFeaturesToMedicinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('medicines', function (Blueprint $table) {
        $table->integer('medicine_group')->unsigned()->nullable();
        $table->string('brand')->nullable();
        $table->string('dosis')->nullable();
        $table->string('presentation')->nullable();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('medicines', function (Blueprint $table) {
        $table->dropColumn('medicine_group');
        $table->dropColumn('brand');
        $table->dropColumn('dosis');
        $table->dropColumn('presentation');
      });
    }
}