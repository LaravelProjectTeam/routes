<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameEdgesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('edges', function (Blueprint $table) {
            $table->renameColumn('from_node_id', 'from_town_id');
            $table->renameColumn('to_node_id', 'to_town_id');
        });

        Schema::rename('edges', 'roads');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('roads', function (Blueprint $table) {
            $table->renameColumn('from_town_id', 'from_node_id');
            $table->renameColumn('to_town_id', 'to_node_id');
        });

        Schema::rename('roads', 'edges');
    }
}
