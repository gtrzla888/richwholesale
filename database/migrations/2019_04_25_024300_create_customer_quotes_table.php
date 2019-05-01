<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerQuotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_quotes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('quote_id')->unique();
            $table->unsignedDecimal('fixed_markup')->default(0);
            $table->unsignedDecimal('percentage_markup')->default(0);
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
        Schema::dropIfExists('customer_quotes');
    }
}
