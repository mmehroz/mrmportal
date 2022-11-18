<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigIncrements('id');
            $table->integer('order_id');
            $table->dateTime('order_time');
            $table->integer('order_status');
            $table->integer('amount');
            $table->string('currency');
            $table->longText('description');
            $table->integer('brand_id');
            $table->integer('send_invoice');
            $table->string('customer_email');
            $table->integer('sale_person');
            $table->boolean('flag')->default(0);
            $table->string('order_date')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
