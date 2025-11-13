<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('plan_name')->nullable();
            $table->integer('price')->nullable();
            $table->integer('speed')->nullable();
            $table->integer('contract')->nullable();
            $table->string('minimum_withdraw')->nullable();
            $table->string('availability')->nullable();
            $table->unsignedInteger('app_id');
            $table->string('image')->nullable();
            $table->string('image_path')->nullable();
            $table->timestamps();

            $table->foreign('app_id')->references('id')->on('apps')
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
        Schema::dropIfExists('plans');
    }
}
