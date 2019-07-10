<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLocationToDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('doctors', function (Blueprint $table) {
        $table->string('doctor_latitude')->after('available')->nullable();
        $table->string('doctor_longitude')->after('available')->nullable();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('doctors', function (Blueprint $table) {
        $table->dropColumn('doctor_latitude');
        $table->dropColumn('doctor_longitude');
      });
    }
}
