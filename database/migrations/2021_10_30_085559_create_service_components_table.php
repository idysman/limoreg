<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceComponentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_components', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->integer("amount");
            $table->foreignId("vehicle_type_id")->references("id")->on("vehicle_types");
            $table->foreignId("service_id")->references("id")->on("services");
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
        Schema::dropIfExists('service_components');
    }
}
