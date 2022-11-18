<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->text('description');
            $table->string('amount')->nullable();
            $table->string('project_type')->nullable();
            $table->string('status')->default('pending');
            $table->integer('profile_id')->nullable();
            $table->integer('customer_id')->nullable();
            $table->integer('sale_id')->nullable();
            $table->integer('bidder_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
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
        Schema::dropIfExists('projects');
    }
}
