<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShuttersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shutters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('width');
            $table->integer('drop');
            $table->string('corner');
            $table->string('panel_layout');
            $table->integer('panel_qty');
            $table->string('in_or_out');
            $table->string('mid_rail');
            $table->string('mid_rail_height')->nullable();
            $table->integer('blade_size');
            $table->string('tilt_rod');
            $table->string('colour');
            $table->string('stile_type');
            $table->string('frame');
            $table->string('frame_options')->nullable();
            $table->string('install_method')->nullable();
            $table->string('hinge_type')->nullable();
            $table->string('hinge_colour')->nullable();
            $table->string('type');
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
        Schema::dropIfExists('shutters');
    }
}
