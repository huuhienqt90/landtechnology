<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->unique();
            $table->longText('description')->nullable();
            $table->string('type_discount');
            $table->integer('cost')->default(0);
            $table->integer('minimum')->default(0);
            $table->integer('maximum')->default(0);
            $table->integer('limit_usage')->default(0);
            $table->string('products_id')->nullable();
            $table->string('categories_id')->nullable();
            $table->datetime('start_date')->nullable();
            $table->datetime('expiry_date')->nullable();
            $table->integer('create_by')->default(0);
            $table->integer('update_by')->default(0);
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
        Schema::dropIfExists('coupons');
    }
}
