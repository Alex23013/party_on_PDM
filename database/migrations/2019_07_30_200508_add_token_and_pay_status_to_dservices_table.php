<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTokenAndPayStatusToDservicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dservices', function (Blueprint $table) {
            $table->boolean('payment_status')->default(0);
            $table->string('token_pay')->default("undefined");
            $table->float('cost')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::table('dservices', function (Blueprint $table) {
            $table->dropColumn('payment_status');
            $table->dropColumn('token_pay');
            $table->dropColumn('cost');
        });
    }
}
