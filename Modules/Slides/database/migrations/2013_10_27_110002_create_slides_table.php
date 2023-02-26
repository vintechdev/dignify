<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSlidesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('slides', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->date('date');
            $table->string('website')->nullable();
            $table->integer('image_id')->unsigned()->nullable();
            $table->json('status');
            $table->json('title');
            $table->json('body');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('slides');
    }
}
