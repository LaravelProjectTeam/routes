<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddOndeleteToEdgesTable extends Migration
{
    /**
     * Run the migrations.            'foreign_key_constraints' => env('DB_FOREIGN_KEYS', false),
     *
     * @return void
     */
    public function up()
    {
        Schema::table('edges', function (Blueprint $table) {
            if (DB::getDriverName() !== 'sqlite') {
                $table->dropForeign('edges_from_node_id_foreign');
                $table->dropForeign('edges_to_node_id_foreign');
                $table->dropForeign('edges_type_id_foreign');
            }

//            $table->dropForeign('edges_from_node_id_foreign');
//            $table->dropForeign('edges_to_node_id_foreign');
//            $table->dropForeign('edges_type_id_foreign');

            $table->foreign('from_node_id')->references('id')->on('nodes')->onDelete('cascade');
            $table->foreign('to_node_id')->references('id')->on('nodes')->onDelete('cascade');
            $table->foreign('type_id')->references('id')->on('road_types')->onDelete('cascade');
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
            //
        });
    }
}
