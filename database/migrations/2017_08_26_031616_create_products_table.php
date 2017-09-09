<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('product_type')->default('simple');
            $table->float('original_price')->default(0);
            $table->float('sale_price')->default(0);
            // $table->float('display_price')->default(0);
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->integer('seller_id')->unsigned();
            $table->string('feature_image')->nullable();
            $table->longText('description_short')->nullable();
            $table->longText('description')->nullable();
            $table->integer('product_brand')->unsigned();
            $table->string('key_words')->nullable();
            $table->integer('sell_type_id')->unsigned();
            // $table->float('discount')->default(0);
            // $table->float('price_after_discount')->default(0);
            $table->string('status')->default('active');
            $table->float('weight')->default(0);
            $table->string('location')->nullable();
            $table->integer('stock')->default(0);
            $table->integer('sold_units')->default(0);
            $table->integer('created_by')->default(0);
            $table->integer('updated_by')->default(0);
            $table->foreign('seller_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->foreign('sell_type_id')
                ->references('id')->on('sell_types')
                ->onDelete('cascade');
            $table->foreign('product_brand')
                ->references('id')->on('brands')
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
        Schema::dropIfExists('products');
    }
}
