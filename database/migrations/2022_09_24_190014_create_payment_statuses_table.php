<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_statuses', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('plan_id');
            $table->string('payment_gateway');
            $table->string('gateway_saltkey');
            $table->string('gateway_merchantkey');
            $table->enum('status',[0,1])->default(0);
            $table->unsignedInteger('user_id');
            $table->string('purchase_time');
            $table->string('purchase_expire_time');
            $table->unsignedInteger('app_id');
            $table->timestamps();

            $table->foreign('app_id')->references('id')->on('apps')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('user_id')->references('id')->on('users')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('plan_id')->references('id')->on('plans')
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
        Schema::dropIfExists('payment_statuses');
    }
}
