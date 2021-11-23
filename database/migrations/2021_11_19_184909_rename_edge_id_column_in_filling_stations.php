<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameEdgeIdColumnInFillingStations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('filling_stations', function (Blueprint $table) {
//            $table->renameColumn('road_id', 'road_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('filling_stations', function (Blueprint $table) {
//            $table->renameColumn('road_id', 'road_id');
        });
    }
}
