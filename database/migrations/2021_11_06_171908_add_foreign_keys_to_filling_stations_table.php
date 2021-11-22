<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToFillingStationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('filling_stations', function (Blueprint $table) {
            $table->unsignedBigInteger('edge_id');
            $table->foreign('edge_id')
                ->references('id')
                ->on('edges')
                ->onDelete('cascade');
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
            $table->dropForeign('filling_stations_edge_id_foreign');
            $table->dropColumn('edge_id');
        });
    }
}
