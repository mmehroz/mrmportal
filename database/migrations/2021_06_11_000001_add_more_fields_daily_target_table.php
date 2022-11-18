<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoreFieldsDailyTargetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('daily_target', function (Blueprint $table) {
            $table->tinyInteger('is_request')->default(0)->after('id');
            $table->tinyInteger('is_approved')->nullable()->after('is_request');
            $table->longText('requested_data')->nullable()->after('is_approved');
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
