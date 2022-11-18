<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDailyTargetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_target', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('bid_link')->nullable();
            $table->string('bid_date')->nullable();
            $table->tinyInteger('is_chat')->default(0);
            $table->tinyInteger('is_sale')->default(0);
            $table->string('amount')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('profile_link')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('daily_target');
    }
}
