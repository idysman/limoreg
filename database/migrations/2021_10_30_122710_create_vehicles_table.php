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
            $table->string("owner_fname");
            $table->string("owner_license_number");
            $table->foreignId("vehicle_type_id")->references("id")->on("vehicle_types");
            $table->string("owner_surname");
            $table->string("owner_email");
            $table->string("owner_phone");
            $table->string("engine_number");
            $table->string("chassis_number");
            $table->string("plate_number");
            $table->string("model");
            $table->string("category");
            $table->string("policy_number");
            $table->string("engine_capacity");
            $table->string("tank_capacity");
            $table->string("odometer");
            $table->string("color");
            $table->string("fuel_type");
            $table->string("year_of_manufacture");
            $table->string("title");
            $table->string("address");
            $table->string("owner_identification");
            $table->string("identification_no");
            $table->string("state");
            $table->string("lga");
            $table->dateTime("last_renewal_date")->nullable();
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
        Schema::dropIfExists('vehicles');
    }
}
