<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductOfferMetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_offer_metas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_offer_id')->unsigned();
            $table->string('key');
            $table->longText('value')->nullable();
            $table->foreign('product_offer_id')
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
        Schema::dropIfExists('product_offer_metas');
    }
}
