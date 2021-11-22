<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameTypeIdColumnInRoadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('roads', function (Blueprint $table) {
            $table->renameColumn('type_id', 'road_type_id');
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
            $table->renameColumn('road_type_id', 'type_id');
        });
    }
}
