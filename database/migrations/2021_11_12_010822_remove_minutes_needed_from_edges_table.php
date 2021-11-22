<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveMinutesNeededFromEdgesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('edges', function (Blueprint $table) {
            $table->dropColumn('minutes_needed');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('edges', function (Blueprint $table) {
            $table->unsignedBigInteger('minutes_needed');
        });
    }
}
