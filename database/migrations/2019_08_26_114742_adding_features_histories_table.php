<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddingFeaturesHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('histories', function (Blueprint $table) {
            $table->float('height')->nullable();
            $table->float('weight')->nullable();
            $table->float('imc')->nullable();
            $table->string('sub_0')->nullable();
            $table->string('sub_1')->nullable();
            $table->string('sub_2')->nullable();
            $table->string('sub_3')->nullable();
            $table->string('sub_4')->nullable();
            $table->string('sub_5')->nullable();
            $table->string('sub_6')->nullable();
            $table->string('sub_7')->nullable();
            $table->string('sub_8')->nullable();
            $table->string('sub_9')->nullable();
            $table->string('aux_exams')->nullable();
            $table->string('diagnosis_impresion')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('histories', function (Blueprint $table) {
            $table->dropColumn('height');
            $table->dropColumn('weight');
            $table->dropColumn('imc');
            $table->dropColumn('sub_0');
            $table->dropColumn('sub_1');
            $table->dropColumn('sub_2');
            $table->dropColumn('sub_3');
            $table->dropColumn('sub_4');
            $table->dropColumn('sub_5');
            $table->dropColumn('sub_6');
            $table->dropColumn('sub_7');
            $table->dropColumn('sub_8');
            $table->dropColumn('sub_9');
            $table->dropColumn('aux_exams');
            $table->dropColumn('diagnosis_impresion');
        });
    }
}
