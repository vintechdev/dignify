<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBrochureDetailsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('brochure_details', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('brochure_id')->unsigned();
            $table->string('tiles_type', 50)->default('default');
            $table->timestamps();
            $table->foreign('brochure_id')->references('id')->on('brochures');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('brochure_details');
    }
}
