<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnsToSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->enum('applovin_ads',[0,1])->default(0);
            $table->string('applovin_small_native_ad')->nullable();
            $table->string('applovin_medium_banner_ad')->nullable();
            $table->string('applovin_large_native_ad')->nullable();
            $table->string('applovin_interstitial_ad')->nullable();
            $table->string('applovin_rewarded_video_ad')->nullable();
            $table->enum('upi_api',[0,1])->default(0);
            $table->string('upi_api_merchant_key')->nullable();
            $table->string('upi_api_token')->nullable();
            $table->string('upi_api_call_back_url')->nullable();
            $table->enum('is_account_delete',[0,1])->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            //
        });
    }
}
