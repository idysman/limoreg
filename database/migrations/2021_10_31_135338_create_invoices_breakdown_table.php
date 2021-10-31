<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesBreakdownTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices_breakdown', function (Blueprint $table) {
            $table->id();
            $table->foreignId("service_id")->references("id")->on("services");
            $table->foreignId("component_id")->references("id")->on("service_components");
            $table->foreignId("invoice_id")->references("id")->on("invoices");
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
        Schema::dropIfExists('invoices_breakdown');
    }
}
