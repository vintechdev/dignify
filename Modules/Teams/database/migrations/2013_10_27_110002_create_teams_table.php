<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->date('date');
            //$table->string('website')->nullable();
            $table->integer('image_id')->unsigned()->nullable();
            $table->json('status');
            $table->json('job_title')->nullable();
            $table->string('name');
            $table->string('slug');

            $table->json('body');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('teams');
    }
}
