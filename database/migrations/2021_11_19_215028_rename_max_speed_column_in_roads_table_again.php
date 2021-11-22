<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameMaxSpeedColumnInRoadsTableAgain extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('roads', function (Blueprint $table) {
            $table->renameColumn('max_speed_in_km', 'max_speed_in_km_per_hour');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('roads', function (Blueprint $table) {
            $table->renameColumn('max_speed_in_km_per_hour', 'max_speed_in_km');
        });
    }
}
