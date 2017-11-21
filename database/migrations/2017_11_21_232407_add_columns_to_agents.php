<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToAgents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('agents', function (Blueprint $table) {
            $table->string('office_phone')->nullable()->after('description');
            $table->string('facebook')->nullable()->after('office_phone');
            $table->string('twitter')->nullable()->after('facebook');
            $table->string('google_plus')->nullable()->after('twitter');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('agents', function (Blueprint $table) {
            $table->dropColumn('office_phone');
            $table->dropColumn('facebook');
            $table->dropColumn('twitter');
            $table->dropColumn('google_plus');



        });
    }
}
