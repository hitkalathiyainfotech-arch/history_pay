<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email');            
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->unsignedInteger('app_id')->nullable();
            $table->enum('role',['0','1'])->default('0');
            $table->string('country')->nullable();
            $table->string('UID')->nullable();
            $table->text('user_key')->nullable();
            $table->string('referral_code')->nullable();
            $table->string('referral_by')->nullable();
            $table->string('mining_point')->nullable();
            $table->string('purchase_detail')->nullable();
            $table->string('device_token')->nullable();
            $table->string('device_type')->nullable();
            $table->string('login_with')->nullable();
            $table->unsignedInteger('plan_id')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('app_id')->references('id')->on('apps')
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
        Schema::dropIfExists('users');
    }
}
