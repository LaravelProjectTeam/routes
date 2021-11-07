<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEdgesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('edges', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('minutes_needed');
            $table->unsignedBigInteger('from_node_id');
            $table->foreign('from_node_id')->references('id')->on('nodes');
            $table->unsignedBigInteger('to_node_id');
            $table->foreign('to_node_id')->references('id')->on('nodes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('edges');
    }
}
