<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyCoordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('coords', function (Blueprint $table) {
            $table->dropForeign('coords_town_id_foreign');
            $table->dropColumn('town_id');
            $table->integer('block_id')->unsigned()->after('id');
            $table->foreign('block_id')->references('id')->on('blocks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('coords', function (Blueprint $table) {
            $table->dropForeign('coords_block_id_foreign');
            $table->dropColumn('block_id');
            $table->integer('town_id')->unsigned()->after('id');
            $table->foreign('town_id')->references('id')->on('towns')->onDelete('cascade');
        });
    }
}
