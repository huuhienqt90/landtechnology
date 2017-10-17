<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVariationAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('variation_attributes', function (Blueprint $table) {
            $table->integer('product_variation_id')->unsigned();
            $table->integer('attribute_id')->unsigned();
            $table->string('value');
            $table->foreign('product_variation_id')
                ->references('id')->on('product_variations')
                ->onDelete('cascade');
            $table->foreign('attribute_id')
                ->references('id')->on('attributes')
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
        Schema::dropIfExists('variation_attributes');
    }
}
