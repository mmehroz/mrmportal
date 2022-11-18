<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoreColumnSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('minimum_order')->nullable();
            $table->string('delivery_time')->nullable();
            $table->string('tax')->nullable();
            $table->time('monday_open_time')->nullable();
            $table->time('monday_close_time')->nullable();
            $table->time('tuesday_open_time')->nullable();
            $table->time('tuesday_close_time')->nullable();
            $table->time('wednesday_open_time')->nullable();
            $table->time('wednesday_close_time')->nullable();
            $table->time('thursday_open_time')->nullable();
            $table->time('thursday_close_time')->nullable();
            $table->time('friday_open_time')->nullable();
            $table->time('friday_close_time')->nullable();
            $table->time('saturday_open_time')->nullable();
            $table->time('saturday_close_time')->nullable();
            $table->time('sunday_open_time')->nullable();
            $table->time('sunday_close_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
