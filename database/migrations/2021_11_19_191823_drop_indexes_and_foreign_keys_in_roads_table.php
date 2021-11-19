<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropIndexesAndForeignKeysInRoadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('roads', function (Blueprint $table) {
//            $table->dropForeign('edges_to_node_id_foreign');
//            $table->dropIndex('edges_to_node_id_foreign');

//            $table->dropForeign('edges_from_node_id_foreign');
//            $table->dropIndex('edges_from_node_id_foreign');

            $table->unique(array('from_town_id', 'to_town_id'));
            $table->dropUnique('edges_from_node_id_to_node_id_unique');

//            $table->dropForeign('edges_type_id_foreign');
//            $table->dropIndex('edges_type_id_foreign');

//            $table->renameIndex('edges_type_id_foreign', 'towns_type_id_foreign');
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
//            $table->dropUnique(['from_town_id', 'to_town_id']);
//            $table->unique(['from_node_id', 'to_node_id']);
        });
    }
}
