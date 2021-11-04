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
            $table->foreignId('created_by')->references("id")->on("users");
            $table->string("owner_phone");
            $table->string("engine_number")->nullable();
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
            $table->string("address");
            $table->string("owner_identification");
            $table->string("identification_no");
            $table->string("state");
            $table->string("lga");
            $table->dateTime("last_renewal_date")->nullable();
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
