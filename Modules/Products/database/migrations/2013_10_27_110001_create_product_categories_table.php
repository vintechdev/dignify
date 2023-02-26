<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('product_categories', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('image_id')->unsigned()->nullable();
            $table->integer('banner_image_id')->unsigned()->nullable();
            $table->integer('home_image_id')->unsigned()->nullable();
            $table->integer('position')->unsigned()->default(0);
            $table->json('status');
            $table->json('title');
            $table->json('slug');
            $table->integer('category_type_id')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('category_type_id')->references('id')->on('product_category_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('product_categories');
    }
}
