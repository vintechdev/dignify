<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBrochuresTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('brochures', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('product_category_id')->unsigned()->nullable();
            $table->integer('tag_id')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('product_category_id')->references('id')->on('product_categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('brochures');
    }
}
