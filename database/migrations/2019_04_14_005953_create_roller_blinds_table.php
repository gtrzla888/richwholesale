<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRollerBlindsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roller_blinds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('order_id');
            $table->string('name');
            $table->integer('width');
            $table->integer('drop');
            $table->string('fabric');
            $table->string('colour');
            $table->string('bracket_colour');
            $table->string('base_rail');
            $table->string('roll_direction');
            $table->string('control_type');
            $table->string('control_side');
            $table->string('chain_length');
            $table->string('motor_brand');
            $table->string('motor_type');
            $table->string('charger')->nullable();
            $table->string('wifi_hub');
            $table->decimal('price'); 
            $table->string('notes')->nullable();  
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
        Schema::dropIfExists('roller_blinds');
    }
}
