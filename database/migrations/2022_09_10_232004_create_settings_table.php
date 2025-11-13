<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('sender_reward_point')->nullable();
            $table->string('receiver_reward_point')->nullable();
            $table->enum('facebook_ads',[0,1])->default(0);
            $table->string('fb_native_ad')->nullable();
            $table->string('fb_native_banner_ad')->nullable();
            $table->string('fb_banner_ad')->nullable();
            $table->string('fb_medium_rectangle_250')->nullable();
            $table->string('fb_interstitial_ad')->nullable();
            $table->string('fb_rewarded_video_ad')->nullable();
            $table->enum('admob_ads_id',[0,1])->default(0);
            $table->string('admob_native_banner_ad')->nullable();
            $table->string('admob_native_ad')->nullable();
            $table->string('admob_banner_ad')->nullable();
            $table->string('admob_interstitial_ad')->nullable();
            $table->string('admob_rewarded_video_ad')->nullable();
            $table->string('admob_app_open')->nullable();
            $table->enum('admob_ads',[0,1])->default(0);
            $table->enum('payment_gateway',[0,1])->default(0);
            $table->enum('razor_pay',[0,1])->default(0);
            $table->string('r_merchant_key')->nullable();
            $table->string('r_solt_key')->nullable();
            $table->enum('payu_new',[0,1])->default(0);
            $table->string('p_new_merchant_key')->nullable();
            $table->string('p_new_solt_key')->nullable();
            $table->enum('payu_old',[0,1])->default(0);
            $table->string('p_old_merchant_key')->nullable();
            $table->string('p_old_solt_key')->nullable();
            $table->enum('cash_free',[0,1])->default(0);
            $table->string('cash_merchant_key')->nullable();
            $table->string('cash_solt_key')->nullable();
            $table->enum('paytm',[0,1])->default(0);
            $table->string('paytm_merchant_key')->nullable();
            $table->string('paytm_solt_key')->nullable();
            $table->enum('upi',[0,1])->default(0);
            $table->string('merchant_upi')->nullable();
            $table->enum('in_app_purchase',[0,1])->default(0);
            $table->enum('show_all_world',[0,1])->default(0);
            $table->enum('outside_india',[0,1])->default(0);
            $table->unsignedInteger('app_id');
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
        Schema::dropIfExists('settings');
    }
}
