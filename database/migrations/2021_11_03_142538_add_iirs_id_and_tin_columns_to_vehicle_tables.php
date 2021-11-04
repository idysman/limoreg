<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIirsIdAndTinColumnsToVehicleTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Vehicles', function (Blueprint $table) {
            $table->string("tin")->nullable();
            $table->string("iirs_id")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Vehicles', function (Blueprint $table) {
            $table->dropColumn("tin");
            $table->dropColumn("iirs_id");
        });
    }
}
