<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveListingFromConversation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('conversations', function (Blueprint $table) {
            $table->dropForeign('conversations_listing_id_foreign');
            $table->dropColumn('listing_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('conversations', function (Blueprint $table) {
            $table->integer('listing_id')->unsigned()->after('id');
            $table->foreign('listing_id')->references('id')->on('listing')->onDelete('cascade');
        });
    }
}
