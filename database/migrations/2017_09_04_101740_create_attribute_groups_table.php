<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributeGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attribute_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('seller_id')->unsigned();
            $table->string('name');
            $table->integer('parent')->default(0);
            $table->string('type')->default('text');
            $table->text('value')->nullable();
            $table->foreign('seller_id')
                ->references('id')->on('users')
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
        Schema::dropIfExists('attribute_groups');
    }
}
