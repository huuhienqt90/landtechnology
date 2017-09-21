<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_offers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('hunting_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->float('offer_price')->default(0);
            $table->longText('comment');
            $table->string('status');
            $table->foreign('hunting_id')
                ->references('id')->on('huntings')
                ->onDelete('cascade');
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('hunting_images', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_offers_id')->unsigned();
            $table->string('image_path');
            $table->string('image_name');
            $table->foreign('product_offers_id')
                ->references('id')->on('product_offers')
                ->onDelete('cascade');
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
        Schema::dropIfExists('hunting_images');
        Schema::dropIfExists('product_offers');
    }
}
