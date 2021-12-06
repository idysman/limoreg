<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecieptTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reciept_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');

            $table->string('description')->nullable();
            $table->integer('valid_duration_years')->nullable();
            $table->string('view_file_name')->nullable();
            // $table->foreign("service_id")->references("id")->on("services")->nullable();
            $table->integer("service_id")->references("id")->on("services")->nullable();
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
        Schema::dropIfExists('reciept_types');
    }
}
