<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status')->default('processing');
            $table->integer('customer')->default(0);
            $table->float('tax')->default(0);
            $table->float('subtotal')->default(0);
            $table->float('total')->default(0);
            $table->longText('customer_note')->nullable();
            $table->timestamps();
        });
        Schema::create('order_metas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->unsigned();
            $table->string('key');
            $table->longText('value')->nullable();
            $table->foreign('order_id')
                ->references('id')->on('orders')
                ->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('order_products', function (Blueprint $table) {
            $table->integer('order_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('variation_id')->default(0);
            $table->float('price')->default(0);
            $table->float('tax')->default(0);
            $table->float('subtotal')->default(0);
            $table->float('total')->default(0);
            $table->integer('qty')->default(0);
            $table->foreign('order_id')
                ->references('id')->on('orders')
                ->onDelete('cascade');
            $table->foreign('product_id')
                ->references('id')->on('products')
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
        Schema::dropIfExists('order_products');
        Schema::dropIfExists('order_metas');
        Schema::dropIfExists('orders');
    }
}
