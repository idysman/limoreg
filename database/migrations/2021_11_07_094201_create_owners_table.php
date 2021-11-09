<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOwnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('owners', function (Blueprint $table) {
            $table->increments('id');
            $table->string("owner_fname");
            $table->string("owner_license_number");
            $table->string("owner_surname");
            $table->string("owner_email");
            $table->string("address");
            $table->string("owner_identification");
            $table->string("identification_no");
            $table->string("state");
            $table->string("lga");
            $table->string("owner_phone");
            $table->softDeletes();
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
        Schema::dropIfExists('owners');
    }
}
