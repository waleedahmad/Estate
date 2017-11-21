<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyListingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('listing', function (Blueprint $table) {
            $table->dropForeign('listing_town_id_foreign');
            $table->dropColumn('town_id');
            $table->integer('block_id')->unsigned()->after('sub_type');
            $table->foreign('block_id')->references('id')->on('blocks');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('listing', function (Blueprint $table) {
            $table->dropForeign('listing_block_id_foreign');
            $table->dropColumn('block_id');
            $table->integer('town_id')->unsigned()->after('sub_type');
            $table->foreign('town_id')->references('id')->on('towns');
        });
    }
}
