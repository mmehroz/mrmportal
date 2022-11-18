<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->nullable();
            $table->integer('attendance_user_id')->nullable();
            $table->string('date')->nullable();
            $table->string('routine_check_in')->nullable();
            $table->string('routine_checkout')->nullable();
            $table->string('today_check_in')->nullable();
            $table->string('today_check_out')->nullable();
            $table->string('difference_time')->nullable();
            $table->string('is_late')->nullable();
            $table->integer('update_by')->nullable();
            $table->text('description')->nullable();
            $table->integer('status')->nullable();
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
        Schema::dropIfExists('attendances');
    }
}
