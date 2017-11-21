<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConversationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conversations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('listing_id')->unsigned();
            $table->foreign('listing_id')->references('id')->on('listing')->onDelete('cascade');
            $table->integer('from')->unsigned();
            $table->integer('to')->unsigned();
            $table->foreign('from')->references('id')->on('users')->onDelete('cascade');;
            $table->foreign('to')->references('id')->on('users')->onDelete('cascade');;
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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('conversations');
        Schema::enableForeignKeyConstraints();
    }
}
