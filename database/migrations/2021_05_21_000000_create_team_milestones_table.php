<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamMilestonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_milestones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('project_id');
            $table->integer('milestone_id');
            $table->string('milestone');
            $table->integer('bidder_id')->nullable();
            $table->string('bidder_amount')->nullable();
            $table->integer('sale_id')->nullable();
            $table->string('sale_amount')->nullable();
            $table->integer('team_id')->nullable();
            $table->string('team_amount')->nullable();
            $table->integer('user_id')->nullable();
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
        Schema::dropIfExists('team_milestones');
    }
}
