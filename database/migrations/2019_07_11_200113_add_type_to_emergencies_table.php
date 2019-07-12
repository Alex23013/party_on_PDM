<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTypeToEmergenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('emergencies', function (Blueprint $table) {
            $table->boolean('emergency_type')->after('attention_id')->default(0);
            /*0: emergencia     1:urgencia */
            $table->integer('response_type')->default(0);
            /*0: sin servicio   1: bomberos     2:cruz roja*/
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('emergencies', function (Blueprint $table) {
            $table->dropColumn('emergency_type');
            $table->dropColumn('response_type');
        });
    }
}
