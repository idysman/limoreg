<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();

            $table->foreignId("vehicle_type_id")->references("id")->on("vehicle_types");
            $table->foreignId('created_by')->references("id")->on("users");
            $table->string("engine_number")->nullable();
            $table->unsignedInteger('owner_id');
            $table->string("chassis_number")->nullable();
            $table->string("plate_number");
            $table->string("model")->nullable();
            $table->string("category");
            $table->string("policy_number");
            $table->string("engine_capacity")->nullable();
            $table->string("tank_capacity")->nullable();
            $table->string("odometer")->nullable();
            $table->string("color");
            $table->string("fuel_type")->nullable();
            $table->string("year_of_manufacture")->nullable();
            $table->string("title");
            $table->dateTime("last_renewal_date")->nullable();
            $table->string("trans_ref");
            $table->string("invoice_nos");
            $table->string("tin")->nullable();
            $table->string("iirs_id")->nullable();
            $table->foreign("owner_id")->references("id")->on("owners");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicles');
    }
}
