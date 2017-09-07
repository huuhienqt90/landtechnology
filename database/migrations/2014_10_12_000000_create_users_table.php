<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('is_admin')->default(0);
            $table->integer('is_buyer')->default(1);
            $table->integer('is_seller')->default(0);
            $table->string('status')->default('active');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('avatar')->nullable();
            $table->string('address1');
            $table->string('address2')->nullable();
            $table->string('country')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('region')->nullable();
            $table->string('password');
            $table->string('is_notify');
            $table->string('confirm_code')->nullable();
            $table->string('confirmed')->default('0');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
