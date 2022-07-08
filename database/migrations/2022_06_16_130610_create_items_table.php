<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();   
            $table->integer('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('name');
            $table->string('status')->default('открыт');
            $table->string('category');
            $table->integer('start_price');
            // $table->string('begin_date');
            $table->string('description');
            $table->integer('price_end');
            $table->string('remaining_time');
            $table->string('old_user')->nullable();
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
        Schema::dropIfExists('items');
    }
};
