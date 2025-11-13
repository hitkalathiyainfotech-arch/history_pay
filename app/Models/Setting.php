<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    public $table = 'settings';

    public $fillable = [
        // 'sender_reward_point',
        'json',
        // 'receiver_reward_point',
        'facebook_ads',
        'fb_native_ad',
        'fb_native_banner_ad',
        'fb_banner_ad',
        'fb_medium_rectangle_250',
        'fb_interstitial_ad',
        'fb_rewarded_video_ad',
        'admob_ads_id',
        'admob_native_banner_ad',
        'admob_native_ad',
        'admob_banner_ad',
        'admob_interstitial_ad',
        'admob_rewarded_video_ad',
        'admob_app_open',
        'admob_ads',
        'isTestAd',
        'isAdmobAndFBMeditation',
        'payment_gateway',
        'razor_pay',
        'razor_merchant_key',
        'razor_solt_key',
        'payu_new',
        'payu_new_merchant_key',
        'payu_new_solt_key',
        'payu_old',
        'payu_old_merchant_key',
        'payu_old_solt_key',
        'cash_free',
        'cash_merchant_key',
        'cash_solt_key',
        'paytm',
        'paytm_merchant_key',
        'paytm_solt_key',
        'upi',
        'upi_merchant',
        'in_app_purchase',
        'show_all_world',
        'outside_india',
        'show_all_user',
        'app_update',
        'show_user_count',
        'app_id',
        'isAppRemove',
        'isShowFailPurchase',
        'isShowPurchaseEntryInFirebase',
        'support_email',
        'privacy_policy',
        // 'active_miner_min',
        // 'active_miner_max',
        'applovin_ads',
        'applovin_small_native_ad',
        'applovin_medium_banner_ad',
        'applovin_large_native_ad',
        'applovin_interstitial_ad',
        'applovin_rewarded_video_ad',
        'upi_api',
        'upi_api_merchant_key',
        'upi_api_token',
        'upi_api_call_back_url',
        // 'is_account_delete',
        'terms_and_condition',
        'mining_session_time',
        'app_update_type_immediate'
    ];
}
