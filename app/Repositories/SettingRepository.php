<?php


namespace App\Repositories;


use App\Models\Setting;
use Cookie;

class SettingRepository extends BaseRepository
{
    /**
     * @var string[]
     */
    protected $fieldsSearchable = [
        // 'sender_reward_point',
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
        'isAppRemove',
        'isShowFailPurchase',
        'isShowPurchaseEntryInFirebase',
        'app_id',
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
        'mining_session_time',
        'app_update_type_immediate',
        'json'
    ];

    /**
     * @return array|string[]
     */
    public function getFieldsSearchable()
    {
       return $this->fieldsSearchable;
    }

    /**
     * @return string
     */
    public function model()
    {
        return Setting::class;
    }

    public function store($input){

        $appId = Cookie::get('appId');
        $input['admob_ads'] = isset($input['admob_ads']) ? '1' : '0';
        $input['applovin_ads'] = isset($input['applovin_ads']) ? '1' : '0';
        // $input['is_account_delete'] = isset($input['is_account_delete']) ? '1' : '0';
        $input['show_all_user'] = isset($input['show_all_user']) ? '1' : '0';
        $input['app_update'] = isset($input['app_update']) ? '1' : '0';
        $input['facebook_ads'] = isset($input['facebook_ads']) ? '1' : '0';
        $input['admob_ads_id'] = isset($input['admob_ads_id']) ? '1' : '0';
        $input['admob_adsadmob_native_banner_ad_id'] = isset($input['admob_native_banner_ad']) ? '1' : '0';
        $input['in_app_purchase'] = isset($input['in_app_purchase']) ? '1' : '0';
        $input['show_all_world'] = isset($input['show_all_world']) ? '1' : '0';
        $input['outside_india'] = isset($input['outside_india']) ? '1' : '0';
        $input['payment_gateway'] = isset($input['payment_gateway']) ? '1' : '0';
        $input['razor_pay'] = isset($input['razor_pay']) ? '1' : '0';
        $input['payu_new'] = isset($input['payu_new']) ? '1' : '0';
        $input['payu_old'] = isset($input['payu_old']) ? '1' : '0';
        $input['cash_free'] = isset($input['cash_free']) ? '1' : '0';
        $input['paytm'] = isset($input['paytm']) ? '1' : '0';
        $input['upi'] = isset($input['upi']) ? '1' : '0';
        $input['upi_api'] = isset($input['upi_api']) ? '1' : '0';
        $input['isTestAd'] = isset($input['isTestAd']) ? '1' : '0';
        $input['isAdmobAndFBMeditation'] = isset($input['isAdmobAndFBMeditation']) ? '1' : '0';
        $input['isAppRemove'] = isset($input['isAppRemove']) ? '1' : '0';
        $input['isShowFailPurchase'] = isset($input['isShowFailPurchase']) ? '1' : '0';
        $input['isShowPurchaseEntryInFirebase'] = isset($input['isShowPurchaseEntryInFirebase']) ? '1' : '0';
        $input['app_update_type_immediate'] = isset($input['app_update_type_immediate']) ? '1' : '0';
        $input['mining_session_time'];
        $input['app_id'] = $appId;



        if($input['id']!=null){
            $this->update($input,$input['id']);
        } else {
            $this->create($input);
        }
    }

    public function appStore($input){
        foreach ($input['apps'] as $apps){
           $setting = Setting::where('app_id',$apps)->first();
            $input['payment_gateway'] = isset($input['payment_gateway']) ? '1' : '0';
            $input['razor_pay'] = isset($input['razor_pay']) ? '1' : '0';
            $input['payu_new'] = isset($input['payu_new']) ? '1' : '0';
            $input['payu_old'] = isset($input['payu_old']) ? '1' : '0';
            $input['cash_free'] = isset($input['cash_free']) ? '1' : '0';
            $input['paytm'] = isset($input['paytm']) ? '1' : '0';
            $input['upi'] = isset($input['upi']) ? '1' : '0';
            $input['upi_api'] = isset($input['upi_api']) ? '1' : '0';
            $input['isTestAd'] = isset($input['isTestAd']) ? '1' : '0';
            $input['isAdmobAndFBMeditation'] = isset($input['isAdmobAndFBMeditation']) ? '1' : '0';
            $input['isAppRemove'] = isset($input['isAppRemove']) ? '1' : '0';
            $input['isShowFailPurchase'] = isset($input['isShowFailPurchase']) ? '1' : '0';
            $input['isShowPurchaseEntryInFirebase'] = isset($input['isShowPurchaseEntryInFirebase']) ? '1' : '0';
            $input['app_id'] = $apps;
           if ($setting){
               $this->update($input,$setting->id);
           } else {
               $this->create($input);
           }
        }
    }
}
