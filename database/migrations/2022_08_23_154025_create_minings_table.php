<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMiningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('minings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mining_point')->nullable();
            $table->string('session_start_time')->nullable();
            $table->string('session_end_time')->nullable();
            $table->string('mining_speed')->nullable();
            $table->string('purchase_start_time')->nullable();
            $table->string('purchase_expire_time')->nullable();
            $table->string('has_rate_speed')->nullable();
            $table->string('reward_point')->nullable();
            $table->unsignedInteger('app_id');
            $table->unsignedInteger('user_id');
            $table->timestamps();

            $table->foreign('app_id')->references('id')->on('apps')
                ->onUpdate('cascade')
                ->onDelete('cascade');

                $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('minings');
    }
}
